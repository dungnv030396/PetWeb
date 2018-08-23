<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Order extends Model
{
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function orderLine()
    {
        return $this->hasMany(OrderLine::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }

    public function moderator()
    {
        return $this->hasOne(User::class, 'id', 'moderator_id');
    }

    public function city()
    {
        return $this->hasOne(City::class, 'code', 'city_code');

    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'warehouse_id');

    }

    public function getOrdersAjax($start, $length, $search, $oderColunm, $oderSortType, $draw)
    {
        $columns = array(
            0 => 'id',
            4 => 'created_at'
        );
        // $page = floor($start / $length) + 1;
        $totalData = Order::where('delete_flag', 0)->count();
        if (empty($search)) {
            $orders = Order::where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orders = Order::whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
                ->orwhereHas('moderator', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->orwhereHas('status', function ($query) use ($search) {
                    $query->where('stt', 'like', "%$search%");
                })
                ->where('delete_flag', '=', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $orders->count();
        }

        $data = array();
        if ($orders) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user->id;
                $nestedData['user_name'] = $order->user->name;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['status_id'] = $order->status_id;
                $nestedData['moderator'] = '';
                if ($order->moderator != null) {
                    $nestedData['moderator_id'] = $order->moderator->id;
                    $nestedData['moderator'] = $order->moderator->name;
                }
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $order->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['orderDetail'] = '
					<center><a href="' . route('orderDetail', $order->id) . '">' . '<b>Chi tiết đơn hàng</b>' . '</a></center>
				';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }

    public function getOrderByID($id)
    {
        return $this->find($id);
    }

    public function orderAssign($request)
    {
        $uObj = new User();
        $order = $this->getOrderByID($request->id);
        $moderator = $uObj->getCurrentUser();
        $order->moderator_id = $moderator->id;
        if ($order->status_id == 1) {
            $order->status_id = 2;
        }
        $order->save();
    }

    public function orderSuccess($request)
    {
        $order = $this->getOrderByID($request->id);
        if ($order->status_id == 4) {
            $order->status_id = 5;

        }
        $order->save();
        $order->completed_at = Carbon::parse($order->updated_at->modify('+7 hours')->format('Y-m-d H:i:s'));
        $order->save();
        foreach ($order->orderLine as $orderLine) {
            $orderLine->orderline_status_id = 5;
            $orderLine->payment_date = Carbon::parse($order->updated_at->modify('+7 days +7 hours')->format('Y-m-d'));
            $orderLine->save();
        }
        $store_benefit = new StoreBenefit();
        $store_benefit->payment_id = $order->payment_id;
        $store_benefit->amount = $order->payment->amount * 0.1;
        $store_benefit->save();
    }

    public function orderAssignDelete($request)
    {
        $order = $this->getOrderByID($request->id);
        $order->moderator_id = null;
        $order->status_id = 1;
        $order->save();
    }

    public function orderDelete($request)
    {
        $order = $this->getOrderByID($request->id);
        $order->delete_flag = 1;
        $order->save();
    }

    public function orderShip($request)
    {
        $order = $this->getOrderByID($request->id);
        $order->status_id = 4;
        $order->save();
        foreach ($order->orderLine as $orderLine) {
            $orderLine->orderline_status_id = 4;
            $orderLine->save();
        }
    }

    public function ordersHistory()
    {
        $user_id = request('id');
        $orders = Order::where('user_id', $user_id)->latest()->paginate(10);
        $number = Order::where('user_id', Auth::user()->id)->count();
        if ($number != 0) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user_id;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['address'] = $order->address;
                $data[] = $nestedData;
            }
            return [
                'orderPaginate' => $orders,
                'allOrders' => $data,
                'number' => $number
            ];
        } else {
            return [
                'orderPaginate' => $orders,
                'allOrders' => null,
                'number' => $number
            ];
        }

    }

    public function searchOrdersHistory()
    {
        $value = request('name');
        if (empty($value)) {
            $orders = Order::whereHas('status', function ($query) use ($value) {
                $query->where('stt', 'like', "%$value%");
            })
//            ->orwhere(function ($query) use ($value) {
//                return $query->where('created_at','like', "%$value%");
//            })
                ->where('id', 'like', "%$value%")
                ->where('user_id', Auth::user()->id)
                ->latest()->paginate(10);
            $number = Order::whereHas('status', function ($query) use ($value) {
                $query->where('stt', 'like', "%$value%");
            })
//                ->orwhere('id', 'like', "%$value%")
                ->where('user_id', Auth::user()->id)
                ->count();
        } else {
            $orders = Order::whereHas('status', function ($query) use ($value) {
                $query->where('stt', 'like', "%$value%");
            })
//            ->orwhere(function ($query) use ($value) {
//                return $query->where('created_at','like', "%$value%");
//            })
                ->where('id', 'like', "%$value%")
                ->where('user_id', Auth::user()->id)
                ->latest()->paginate(10);
            $number = Order::whereHas('status', function ($query) use ($value) {
                $query->where('stt', 'like', "%$value%");
            })
                ->where('id', 'like', "%$value%")
                ->where('user_id', Auth::user()->id)
                ->count();
        }


        if ($number != 0) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user_id;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['address'] = $order->address;
                $data[] = $nestedData;
            }
            return [
                'orderPaginate' => $orders,
                'allOrders' => $data,
                'number' => $number
            ];
        } else {
            return [
                'orderPaginate' => $orders,
                'allOrders' => null,
                'number' => $number
            ];
        }
    }

    public function getOrdersWarehouseAjax($start, $length, $search, $oderColunm, $oderSortType, $draw, $warehouse_id)
    {
        $columns = array(
            0 => 'id',
            4 => 'created_at'
        );
        // $page = floor($start / $length) + 1;
        $totalData = Order::where('delete_flag', 0)->whereHas('warehouse', function ($query) use ($warehouse_id) {
            $query->where('id', $warehouse_id);
        })->count();
        if (empty($search)) {
            $orders = Order::whereHas('warehouse', function ($query) use ($warehouse_id) {
                $query->where('id', $warehouse_id);
            })
                ->where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $totalData;
        } else {
            $orders = Order::whereHas('moderator', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            })
                ->orwhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%");
                })
                ->orwhereHas('status', function ($query) use ($search) {
                    $query->where('stt', 'like', "%$search%");
                })
                ->orWhere('id', 'like', "%$search%")
                ->whereHas('warehouse', function ($query) use ($warehouse_id) {
                    $query->where('id', $warehouse_id);
                })
                ->where('delete_flag', 0)
                ->offset($start)
                ->limit($length)
                ->orderBy($columns[$oderColunm], $oderSortType)
                ->get();
            $totalFiltered = $orders->count();
        }

        $data = array();
        if ($orders) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['id'] = $order->id;
                $nestedData['user_id'] = $order->user->id;
                $nestedData['user_name'] = $order->user->name;
                $nestedData['status'] = $order->status['stt'];
                $nestedData['status_id'] = $order->status_id;
                $nestedData['moderator'] = '';
                if ($order->moderator != null) {
                    $nestedData['moderator_id'] = $order->moderator->id;
                    $nestedData['moderator'] = $order->moderator->name;
                }
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['updated_at'] = $order->updated_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['orderDetail'] = '
					<a href="' . route('orderDetail', $order->id) . '">' . '<b>Chi tiết đơn hàng</b>' . '</a>
				';
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data
        );
        return $json_data;
    }

    public function getStore_financeAjax($start, $length, $search, $oderColunm, $oderSortType, $draw, $startDate, $endDate, $moderator_id)
    {
        $columns = array(
            0 => 'id',
            4 => 'created_at',
            5 => 'completed_at'
        );
        $startDate = substr($startDate, -4) . '-' . substr($startDate, 0, 1) . substr($startDate, 1, -5) . ' 00:00:00';
        $endDate = substr($endDate, -4) . '-' . substr($endDate, 0, 1) . substr($endDate, 1, -5) . ' 23:59:59';
        $totalAmount = 0;
        $totalBenefit = 0;
        if ($moderator_id == 0) {
            $totalData = Order::where('status_id', 5)->where('delete_flag', 0)
                ->whereBetween('completed_at', [$startDate, $endDate])->count();
            if (empty($search)) {
                $orders = Order::where('status_id', 5)->where('delete_flag', 0)
                    ->whereBetween('completed_at', [$startDate, $endDate])
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($columns[$oderColunm], $oderSortType)
                    ->get();
                $totalFiltered = $totalData;
            } else {
                $orders = Order::where('status_id', 5)
                    ->where('delete_flag', 0)
                    ->whereBetween('completed_at', [$startDate, $endDate])
                    ->where('id', 'like', "%$search%")
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($columns[$oderColunm], $oderSortType)
                    ->get();
                $totalFiltered = $orders->count();
            }
        } else {
            $totalData = Order::where('status_id', 5)->where('delete_flag', 0)
                ->whereHas('moderator', function ($query) use ($moderator_id) {
                    $query->where('id', $moderator_id)->where('delete_flag', 0);
                })
                ->whereBetween('completed_at', [$startDate, $endDate])->count();
            if (empty($search)) {
                $orders = Order::where('status_id', 5)->where('delete_flag', 0)
                    ->whereHas('moderator', function ($query) use ($moderator_id) {
                        $query->where('id', $moderator_id)->where('delete_flag', 0);
                    })
                    ->whereBetween('completed_at', [$startDate, $endDate])
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($columns[$oderColunm], $oderSortType)
                    ->get();
                $totalFiltered = $totalData;
            } else {
                $orders = Order::where('status_id', 5)
                    ->where('delete_flag', 0)
                    ->whereHas('moderator', function ($query) use ($moderator_id) {
                        $query->where('id', $moderator_id)->where('delete_flag', 0);
                    })
                    ->whereBetween('completed_at', [$startDate, $endDate])
                    ->where('id', 'like', "%$search%")
                    ->offset($start)
                    ->limit($length)
                    ->orderBy($columns[$oderColunm], $oderSortType)
                    ->get();
                $totalFiltered = $orders->count();
            }
        }

        $data = array();
        if ($orders) {
            foreach ($orders as $order) {
                $nestedData = array();
                $nestedData['order_id'] = $order->id;
                $nestedData['moderator_id'] = $order->moderator->id;
                $nestedData['moderator_name'] = $order->moderator->name;
                $nestedData['moderator_phoneNumber'] = $order->moderator->phoneNumber;
                $nestedData['moderator_address'] = $order->moderator->address;
                $nestedData['moderator_email'] = $order->moderator->email;
                $nestedData['amount'] = number_format($order->payment->amount);
                $nestedData['store_benefit'] = number_format($order->payment->store_benefit->amount);
                $nestedData['created_at'] = $order->created_at->modify('+7 hours')->format('H:i:s d/m/Y');
                $nestedData['completed_at'] = Carbon::parse($order->completed_at)->format('H:i:s d/m/Y');
                $totalAmount += $order->payment->amount;
                $totalBenefit += $order->payment->store_benefit->amount;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($draw),
            // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
            "recordsTotal" => intval($totalData),
            // total number of records
            "recordsFiltered" => intval($totalFiltered),
            // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data,
            //tổng doanh thu
            "totalAmount" => number_format($totalAmount),
            //tổng lợi nhuận
            "totalBenefit" => number_format($totalBenefit)
        );
        return $json_data;
    }

    public function getOrdersDataMonth()
    {
        $number_ordersCurrentMonth = 0;
        $month = date('m');
        $year = date('Y');
        $orders = Order::whereRaw('YEAR(created_at) = ?', $year)->whereRaw('MONTH(created_at) = ?', $month)->where('delete_flag', 0)->orderBy('created_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d');
        });
        $data = array();
        if ($orders) {
            $j = 1;
            foreach ($orders as $order) {
                for ($i = $j; $i <= date('t'); $i++) {
                    $day = Carbon::parse($order[0]->created_at)->format('d');
                    if ($i == $day) {
                        $number = $order->count();
                        $number_ordersCurrentMonth += $number;
                        $j = $i + 1;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'day' => (int)$day,
                            'number' => $number,
                        ];
                    } else {
                        $day = $i;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'day' => (int)$day,
                            'number' => 0
                        ];
                    }
                }
            }
        } else {
            $year = date('Y');
            for ($i = 1; $i <= date('t'); $i++) {
                $data[$i] = [
                    'year' => $year,
                    'month' => $month,
                    'day' => $i,
                    'number' => 0
                ];
            }
        }
        $ordersLastMonth = 0;
        if ((int)$month == 1) {
            $month = 12;
            $year = (int)$year - 1;
            $ordersLastMonth = Order::whereRaw('YEAR(created_at) = ?', $year)->whereRaw('MONTH(created_at) = ?', $month)->where('delete_flag', 0)->count();
        } else {
            $month = (int)$month - 1;
            $ordersLastMonth = Order::whereRaw('YEAR(created_at) = ?', $year)->whereRaw('MONTH(created_at) = ?', $month)->where('delete_flag', 0)->count();
        }
        $data['month_number'] = number_format($number_ordersCurrentMonth);
        $data['last_month_number'] = $ordersLastMonth;
        if ($ordersLastMonth == 0) {
            $data['percent'] = 100;
        } else {
            $data['percent'] = round($number_ordersCurrentMonth / $ordersLastMonth * 100, 2);
        }
        return $data;
    }

    public function getOrdersDataYear()
    {
        $number_ordersCurrentYear = 0;
        $year = date('Y');
        $orders = Order::whereRaw('YEAR(created_at) = ?', $year)->where('delete_flag', 0)->orderBy('created_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
        $data = array();
        if ($orders) {
            $j = 1;
            foreach ($orders as $order) {
                for ($i = $j; $i <= 12; $i++) {
                    $month = Carbon::parse($order[0]->created_at)->format('m');
                    if ($i == $month) {
                        $number = $order->count();
                        $number_ordersCurrentYear += $number;
                        $j = $i + 1;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'number' => $number,
                        ];
                    } else {
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => $i,
                            'number' => 0
                        ];
                    }
                }
            }
        } else {
            $year = date('Y');
            for ($i = 1; $i <= 12; $i++) {
                $data[$i] = [
                    'year' => $year,
                    'month' => $i,
                    'number' => 0
                ];
            }
        }
        $ordersLastYear = 0;
        $year = (int)$year - 1;
        $ordersLastYear = Order::whereRaw('YEAR(created_at) = ?', $year)->where('delete_flag', 0)->count();
        $data['year_number'] = number_format($number_ordersCurrentYear);
        $data['last_year_number'] = $ordersLastYear;
        if ($ordersLastYear == 0) {
            $data['percent'] = 100;
        } else {
            $data['percent'] = round($number_ordersCurrentYear / $ordersLastYear * 100, 2);
        }
        return $data;
    }

    public function getOrdersDataAnnual()
    {
        $number_orders = 0;
        $orders = Order::where('delete_flag', 0)->orderBy('created_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('Y');
        });
        $data = array();
        $i = 1;
        if ($orders) {
            foreach ($orders as $order) {
                $year = Carbon::parse($order[0]->created_at)->format('Y');
                $number = $order->count();
                $number_orders += $number;
                $data[$i] = [
                    'year' => (int)$year,
                    'number' => $number,
                ];
                $i++;
            }
        }
        $data['year_record'] = $orders->count();
        $data['year_number'] = number_format($number_orders);
        return $data;
    }

    public function getFinanceDataMonth()
    {
        $number_FinanceCurrentMonth = 0;
        $month = date('m');
        $year = date('Y');
        $orders = Order::whereRaw('YEAR(completed_at) = ?', $year)->whereRaw('MONTH(completed_at) = ?', $month)->where('delete_flag', 0)->orderBy('completed_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->completed_at)->format('d');
        });
        $data = array();
        if ($orders) {
            $j = 1;
            foreach ($orders as $order) {
                for ($i = $j; $i <= date('t'); $i++) {
                    $day = Carbon::parse($order[0]->completed_at)->format('d');
                    if ($i == $day) {
                        $number = 0;
                        foreach ($order as $orderP) {
                            $number += $orderP->payment->amount;
                        }
                        $number_FinanceCurrentMonth += $number;
                        $j = $i + 1;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'day' => (int)$day,
                            'number' => $number
                        ];
                    } else {
                        $day = $i;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'day' => (int)$day,
                            'number' => 0
                        ];
                    }
                }
            }
        } else {
            $year = date('Y');
            for ($i = 1; $i <= date('t'); $i++) {
                $data[$i] = [
                    'year' => $year,
                    'month' => $month,
                    'day' => $i,
                    'number' => 0
                ];
            }
        }
        $financeLastMonth = 0;
        if ((int)$month == 1) {
            $month = 12;
            $year = (int)$year - 1;
        } else {
            $month = (int)$month - 1;
        }
        $orders = Order::whereRaw('YEAR(completed_at) = ?', $year)->whereRaw('MONTH(completed_at) = ?', $month)->where('delete_flag', 0)->orderBy('completed_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->completed_at)->format('d');
        });
        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order as $orderP) {
                    $financeLastMonth += $orderP->payment->amount;
                }
            }
        }
        $data['month_number'] = number_format($number_FinanceCurrentMonth);
        $data['last_month_number'] = $financeLastMonth;
        if ($financeLastMonth == 0) {
            $data['percent'] = 100;
        } else {
            $data['percent'] = round($number_FinanceCurrentMonth / $financeLastMonth * 100, 2);
        }
        return $data;
    }

    public function getFinanceDataAnnual()
    {
        $number_FinanceCurrentYear = 0;
        $orders = Order::where('delete_flag', 0)->orderBy('completed_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->completed_at)->format('Y');
        });
        $data = array();
        $i = 1;
        if ($orders) {
            foreach ($orders as $order) {
                $year = Carbon::parse($order[0]->completed_at)->format('Y');
                $number = 0;
                foreach ($order as $orderP) {
                    $number += $orderP->payment->amount;
                }
                $number_FinanceCurrentYear += $number;
                $data[$i] = [
                    'year' => (int)$year,
                    'number' => $number,
                ];
                $i++;
            }
        }
        $data['year_record'] = $orders->count();
        $data['year_number'] = number_format($number_FinanceCurrentYear);
        return $data;
    }

    public function getFinanceDataYear()
    {
        $number_FinanceCurrentYear = 0;
        $year = date('Y');
        $orders = Order::whereRaw('YEAR(completed_at) = ?', $year)->orderBy('completed_at', 'asc')->where('delete_flag', 0)->get()->groupBy(function ($date) {
            return Carbon::parse($date->completed_at)->format('m');
        });
        $data = array();
        if ($orders) {
            $j = 1;
            foreach ($orders as $order) {
                for ($i = $j; $i <= 12; $i++) {
                    $month = Carbon::parse($order[0]->completed_at)->format('m');
                    if ($i == $month) {
                        $number = 0;
                        foreach ($order as $orderP) {
                            $number += $orderP->payment->amount;
                        }
                        $number_FinanceCurrentYear += $number;
                        $j = $i + 1;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'number' => $number
                        ];
                    } else {
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => $i,
                            'number' => 0
                        ];
                    }
                }
            }
        } else {
            $year = date('Y');
            for ($i = 1; $i <= 12; $i++) {
                $data[$i] = [
                    'year' => $year,
                    'month' => $i,
                    'number' => 0
                ];
            }
        }
        $financeLastYear = 0;
        $year = (int)$year - 1;
        $orders = Order::whereRaw('YEAR(completed_at) = ?', $year)->orderBy('completed_at', 'asc')->where('delete_flag', 0)->get()->groupBy(function ($date) {
            return Carbon::parse($date->completed_at)->format('m');
        });
        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order as $orderP) {
                    $financeLastYear += $orderP->payment->amount;
                }
            }
        }
        $data['year_number'] = number_format($number_FinanceCurrentYear);
        $data['last_year_number'] = $financeLastYear;
        if ($financeLastYear == 0) {
            $data['percent'] = 100;
        } else {
            $data['percent'] = round($number_FinanceCurrentYear / $financeLastYear * 100, 2);
        }
        return $data;
    }

    public function getEstimateFinanceDataMonth()
    {
        $number_FinanceCurrentMonth = 0;
        $month = date('m');
        $year = date('Y');
        $orders = Order::whereRaw('YEAR(created_at) = ?', $year)->whereRaw('MONTH(created_at) = ?', $month)->where('delete_flag', 0)->orderBy('created_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d');
        });
        $data = array();
        if ($orders) {
            $j = 1;
            foreach ($orders as $order) {
                for ($i = $j; $i <= date('t'); $i++) {
                    $day = Carbon::parse($order[0]->created_at)->format('d');
                    if ($i == $day) {
                        $number = 0;
                        foreach ($order as $orderP) {
                            $number += $orderP->payment->amount;
                        }
                        $number_FinanceCurrentMonth += $number;
                        $j = $i + 1;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'day' => (int)$day,
                            'number' => $number
                        ];
                    } else {
                        $day = $i;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'day' => (int)$day,
                            'number' => 0
                        ];
                    }
                }
            }
        } else {
            $year = date('Y');
            for ($i = 1; $i <= date('t'); $i++) {
                $data[$i] = [
                    'year' => $year,
                    'month' => $month,
                    'day' => $i,
                    'number' => 0
                ];
            }
        }
        $financeLastMonth = 0;
        if ((int)$month == 1) {
            $month = 12;
            $year = (int)$year - 1;
        } else {
            $month = (int)$month - 1;
        }
        $orders = Order::whereRaw('YEAR(created_at) = ?', $year)->whereRaw('MONTH(created_at) = ?', $month)->where('delete_flag', 0)->orderBy('created_at', 'asc')->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d');
        });
        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order as $orderP) {
                    $financeLastMonth += $orderP->payment->amount;
                }
            }
        }
        $data['month_number'] = number_format($number_FinanceCurrentMonth);
        $data['last_month_number'] = $financeLastMonth;
        if ($financeLastMonth == 0) {
            $data['percent'] = 100;
        } else {
            $data['percent'] = round($number_FinanceCurrentMonth / $financeLastMonth * 100, 2);
        }
        return $data;
    }

    public function getEstimateFinanceDataYear()
    {
        $number_FinanceCurrentYear = 0;
        $year = date('Y');
        $orders = Order::whereRaw('YEAR(created_at) = ?', $year)->orderBy('created_at', 'asc')->where('delete_flag', 0)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
        $data = array();
        if ($orders) {
            $j = 1;
            foreach ($orders as $order) {
                for ($i = $j; $i <= 12; $i++) {
                    $month = Carbon::parse($order[0]->created_at)->format('m');
                    if ($i == $month) {
                        $number = 0;
                        foreach ($order as $orderP) {
                            $number += $orderP->payment->amount;
                        }
                        $number_FinanceCurrentYear += $number;
                        $j = $i + 1;
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => (int)$month,
                            'number' => $number
                        ];
                    } else {
                        $data[$i] = [
                            'year' => (int)$year,
                            'month' => $i,
                            'number' => 0
                        ];
                    }
                }
            }
        } else {
            $year = date('Y');
            for ($i = 1; $i <= 12; $i++) {
                $data[$i] = [
                    'year' => $year,
                    'month' => $i,
                    'number' => 0
                ];
            }
        }
        $financeLastYear = 0;
        $year = (int)$year - 1;
        $orders = Order::whereRaw('YEAR(created_at) = ?', $year)->orderBy('created_at', 'asc')->where('delete_flag', 0)->get()->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });
        if ($orders) {
            foreach ($orders as $order) {
                foreach ($order as $orderP) {
                    $financeLastYear += $orderP->payment->amount;
                }
            }
        }
        $data['year_number'] = number_format($number_FinanceCurrentYear);
        $data['last_year_number'] = $financeLastYear;
        if ($financeLastYear == 0) {
            $data['percent'] = 100;
        } else {
            $data['percent'] = round($number_FinanceCurrentYear / $financeLastYear * 100, 2);
        }
        return $data;
    }

}
