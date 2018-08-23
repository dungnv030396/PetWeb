@extends('AdminView.master')
@section('contentManager')
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Tổng</span>
                    <h5>Doanh Thu</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{number_format($headerData[0])}}</h1>
                    <small>Đơn vị VNĐ</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Tổng</span>
                    <h5>Lợi Nhuận</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{number_format($headerData[1])}}</h1>
                    <small>Lợi nhuận bằng 10% mỗi đơn hàng</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Hợp lệ</span>
                    <h5>Đơn Hàng</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{number_format($headerData[2])}}</h1>
                    <small>Trên tổng {{number_format($headerData[3])}} đơn hàng</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <span class="label label-success pull-right">Đang hoạt động</span>
                    <h5>Tài Khoản</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{number_format($headerData[4])}}</h1>
                    <small>Trên tổng {{number_format($headerData[5])}} tài khoản</small>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-xs btn-white" id="btnToday">Ngày</button>
                            <button type="button" class="btn btn-xs btn-white" id="btnMonthly">Tháng</button>
                            <button type="button" class="btn btn-xs btn-white" id="btnAnnual">Năm</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                            </div>
                        </div>
                        <div class="col-lg-3" id="loadData">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="source/assets/manage/js/jquery-2.1.1.js"></script>
    <script>
        $(document).ready(function () {
            document.getElementById('btnToday').click();

        });
        $('#btnAnnual').on('click',function (e) {
            console.log('month');
            $.ajax({
                type: "POST",
                url: "{{route('loadDataFinanceYears')}}",
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function (data) {
                    var orders = [];
                    for ( i = 1; i <= data['orders']['year_record']; i++){
                        orders[i-1] = [gdAnnual(data['orders'][i]['year'],1), data['orders'][i]['number']];
                    }
                    var realIncome = [];
                    for ( i = 1; i <= data['realIncome']['year_record']; i++){
                        realIncome[i-1] = [gdAnnual(data['realIncome'][i]['year'],1), data['realIncome'][i]['number']];
                    }
                    var dataset = [
                        {
                            label: "Số lượng đơn hàng",
                            data: orders,
                            color: "#1ab394",
                            bars: {
                                show: true,
                                align: "center",
                                barWidth: 96 * 240 * 240 * 2400,
                                lineWidth: 0
                            }

                        },
                        {
                            label: "Doanh thu thực tế",
                            data: realIncome,
                            yaxis: 2,
                            color: "#1C84C6",
                            lines: {
                                lineWidth: 1,
                                show: true,
                            },
                            splines: {
                                show: false,
                                tension: 0.6,
                                lineWidth: 1,
                                fill: 0.1
                            },
                        }
                    ];

                    var options = {
                        xaxis: {
                            mode: "time",
                            timeformat: '%Y',
                            tickSize: [1, "year"],
                            tickLength: 0,
                            axisLabel: "Date",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 10,
                            color: "#d5d5d5",

                        },
                        yaxes: [{
                            position: "left",
                            color: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 3
                        }, {
                            position: "right",
                            clolor: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: ' Arial',
                            axisLabelPadding: 67
                        }
                        ],
                        legend: {
                            noColumns: 1,
                            labelBoxBorderColor: "#000000",
                            position: "nw"
                        },
                        grid: {
                            hoverable: false,
                            borderWidth: 0
                        },
                        points: {show: true},
                    };
                    function gdAnnual(year,month) {
                        return new Date(year, month - 1).getTime();
                    }

                    var previousPoint = null, previousLabel = null;

                    $.plot($("#flot-dashboard-chart"), dataset, options);
                    $('#loadData').html("<ul class=\"stat-list\">\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins\">"+ data['orders']['year_number'] +"</h2>\n" +
                        "                                    <small>Tổng số đơn hàng</small>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: 100%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins \">"+ data['realIncome']['year_number'] +"</h2>\n" +
                        "                                    <small>Tổng doanh thu</small>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: 100%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                            </ul>");
                    document.getElementById('btnAnnual').focus();
                }
            });
        });
        $('#btnMonthly').on('click',function (e) {
            console.log('month');
            $.ajax({
                type: "POST",
                url: "{{route('loadDataFinanceMonths')}}",
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function (data) {
                    var orders = [];
                    for ( i = 1; i <= 12; i++){
                        orders[i-1] = [gdMonth(data['orders'][i]['year'], data['orders'][i]['month']), data['orders'][i]['number']];
                    }
                    console.log(orders);
                    var realIncome = [];
                    for ( i = 1; i <= 12; i++){
                        realIncome[i-1] = [gdMonth(data['realIncome'][i]['year'], data['realIncome'][i]['month']), data['realIncome'][i]['number']];
                    }
                    var estimateIncome = [];
                    for ( i = 1; i <= 12; i++){
                        estimateIncome[i-1] = [gdMonth(data['estimateIncome'][i]['year'], data['estimateIncome'][i]['month']), data['estimateIncome'][i]['number']];
                    }
                    var dataset = [
                        {
                            label: "Số lượng đơn hàng",
                            data: orders,
                            color: "#1ab394",
                            bars: {
                                show: true,
                                align: "center",
                                barWidth: 48 * 120 * 120 * 1200,
                                lineWidth: 0
                            }

                        },
                        {
                            label: "Doanh thu thực tế",
                            data: realIncome,
                            yaxis: 2,
                            color: "#1C84C6",
                            lines: {
                                lineWidth: 1,
                                show: true,
                            },
                            splines: {
                                show: false,
                                tension: 0.6,
                                lineWidth: 1,
                                fill: 0.1
                            },
                        },
                        {
                            label: "Doanh thu dự kiến",
                            data: estimateIncome,
                            yaxis: 2,
                            color: "#7ec68d",
                            lines: {
                                lineWidth: 1,
                                show: true,
                            },
                            splines: {
                                show: false,
                                tension: 0.6,
                                lineWidth: 1,
                                fill: 0.1
                            },
                        }
                    ];

                    var options = {
                        xaxis: {
                            mode: "time",
                            timeformat: '%m/%Y',
                            tickSize: [1, "month"],
                            tickLength: 0,
                            axisLabel: "Date",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 10,
                            color: "#d5d5d5",

                        },
                        yaxes: [{
                            position: "left",
                            color: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 3
                        }, {
                            position: "right",
                            clolor: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: ' Arial',
                            axisLabelPadding: 67
                        }
                        ],
                        legend: {
                            noColumns: 1,
                            labelBoxBorderColor: "#000000",
                            position: "nw"
                        },
                        grid: {
                            hoverable: false,
                            borderWidth: 0
                        },
                        points: {show: true},
                    };

                    function gdMonth(year,month) {
                        return new Date(year, month - 1).getTime();
                    }

                    var previousPoint = null, previousLabel = null;

                    $.plot($("#flot-dashboard-chart"), dataset, options);
                    $('#loadData').html("<ul class=\"stat-list\">\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins\">"+ data['orders']['year_number'] +"</h2>\n" +
                        "                                    <small>Số đơn hàng so với năm trước</small>\n" +
                        "                                    <div class=\"stat-percent\">"+ data['orders']['percent'] +"% </div>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: "+ data['orders']['percent'] +"%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins \">"+ data['realIncome']['year_number'] +"</h2>\n" +
                        "                                    <small>Doanh thu so với năm trước</small>\n" +
                        "                                    <div class=\"stat-percent\">"+ data['realIncome']['percent'] +"% </div>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: "+ data['realIncome']['percent'] +"%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins \">"+ data['estimateIncome']['year_number'] +"</h2>\n" +
                        "                                    <small>Doanh thu dự tính</small>\n" +
                        "                                    <div class=\"stat-percent\">"+ data['estimateIncome']['percent'] +"% </div>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: "+ data['estimateIncome']['percent'] +"%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                            </ul>");
                    document.getElementById('btnMonthly').focus();
                }
            });
        });

        $('#btnToday').on('click', function (e) {
            console.log('today');
            $.ajax({
                type: "POST",
                url: "{{route('loadDataFinanceDays')}}",
                data: {
                    _token: "{{csrf_token()}}"
                },
                success: function (data) {
                    var orders = [];
                    for ( i = 1; i <= data['days']; i++){
                         orders[i-1] = [gd(data['orders'][i]['year'], data['orders'][i]['month'], data['orders'][i]['day']), data['orders'][i]['number']];
                    }
                    var realIncome = [];
                    for ( i = 1; i <= data['days']; i++){
                        realIncome[i-1] = [gd(data['realIncome'][i]['year'], data['realIncome'][i]['month'], data['realIncome'][i]['day']), data['realIncome'][i]['number']];
                    }
                    var estimateIncome = [];
                    for ( i = 1; i <= data['days']; i++){
                        estimateIncome[i-1] = [gd(data['estimateIncome'][i]['year'], data['estimateIncome'][i]['month'], data['estimateIncome'][i]['day']), data['estimateIncome'][i]['number']];
                    }
                    var dataset = [
                        {
                            label: "Số lượng đơn hàng",
                            data: orders,
                            color: "#1ab394",
                            bars: {
                                show: true,
                                align: "center",
                                barWidth: 24 * 60 * 60 * 600,
                                lineWidth: 0
                            }

                        },
                        {
                            label: "Doanh thu thực tế",
                            data: realIncome,
                            yaxis: 2,
                            color: "#1C84C6",
                            lines: {
                                lineWidth: 1,
                                show: true,
                            },
                            splines: {
                                show: false,
                                tension: 0.6,
                                lineWidth: 1,
                                fill: 0.1
                            },
                        },
                        {
                            label: "Doanh thu dự kiến",
                            data: estimateIncome,
                            yaxis: 2,
                            color: "#7ec68d",
                            lines: {
                                lineWidth: 1,
                                show: true,
                            },
                            splines: {
                                show: false,
                                tension: 0.6,
                                lineWidth: 1,
                                fill: 0.1
                            },
                        }
                    ];

                    var options = {
                        xaxis: {
                            mode: "time",
                            timeformat: '%d/%m',
                            tickSize: [2, "day"],
                            tickLength: 0,
                            axisLabel: "Date",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 10,
                            color: "#d5d5d5",

                        },
                        yaxes: [{
                            position: "left",
                            color: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: 'Arial',
                            axisLabelPadding: 3
                        }, {
                            position: "right",
                            clolor: "#d5d5d5",
                            axisLabelUseCanvas: true,
                            axisLabelFontSizePixels: 12,
                            axisLabelFontFamily: ' Arial',
                            axisLabelPadding: 67
                        }
                        ],
                        legend: {
                            noColumns: 1,
                            labelBoxBorderColor: "#000000",
                            position: "nw"
                        },
                        grid: {
                            hoverable: false,
                            borderWidth: 0
                        },
                        points: {show: true},
                    };

                    function gd(year, month, day) {
                        return new Date(year, month - 1, day).getTime();
                    }

                    var previousPoint = null, previousLabel = null;

                    $.plot($("#flot-dashboard-chart"), dataset, options);
                    $('#loadData').html("<ul class=\"stat-list\">\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins\">"+ data['orders']['month_number'] +"</h2>\n" +
                        "                                    <small>Số đơn hàng so với tháng trước</small>\n" +
                        "                                    <div class=\"stat-percent\">"+ data['orders']['percent'] +"% </div>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: "+ data['orders']['percent'] +"%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins \">"+ data['realIncome']['month_number'] +"</h2>\n" +
                        "                                    <small>Doanh thu so với tháng trước</small>\n" +
                        "                                    <div class=\"stat-percent\">"+ data['realIncome']['percent'] +"% </div>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: "+ data['realIncome']['percent'] +"%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                                <li>\n" +
                        "                                    <h2 class=\"no-margins \">"+ data['estimateIncome']['month_number'] +"</h2>\n" +
                        "                                    <small>Doanh thu dự tính</small>\n" +
                        "                                    <div class=\"stat-percent\">"+ data['estimateIncome']['percent'] +"% </div>\n" +
                        "                                    <div class=\"progress progress-mini\">\n" +
                        "                                        <div style=\"width: "+ data['estimateIncome']['percent'] +"%;\" class=\"progress-bar\"></div>\n" +
                        "                                    </div>\n" +
                        "                                </li>\n" +
                        "                            </ul>");
                    document.getElementById('btnToday').focus();
                }
            });


        })
    </script>


@endsection
