// 自定义js
$(function () {

    $(".sidebar .root").each(function () {
        if ($(this).hasClass('focus')) {
            $(this).children(".parent").append('<i class="icon icon-angle-down">&#xf107;</i>');
        } else {
            $(this).children(".parent").append('<i class="icon icon-angle-up">&#xf106;</i>');
        }
    });

    $(".parent").click(function (event) {
        event.preventDefault();
        $(this).next().slideToggle();
        if ($(this).children('i').hasClass('icon-angle-up')) {
            $(this).children('i').remove();
            $(this).append('<i class="icon icon-angle-down">&#xf107;</i>');
        } else {
            $(this).children('i').remove();
            $(this).append('<i class="icon icon-angle-up">&#xf106;</i>');
        }
    })
})

function Monitor() {
    View();
    Device();
}

function View() {
    var option = {
        title: {
            text: '站点访问量统计',
            left: 'center'
        },
        xAxis: {
            type: 'category',
            data: ['一小时内', '一天内', '一周内', '一月内', '一年内', '总计']
        },
        yAxis: {
            type: 'value'
        },
        series: [{
            data: monitorViews.view,
            type: 'bar',
            itemStyle: {
                normal: {
                    color: function (params) {
                        var colorList = ['#ca8622', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83'];
                        return colorList[params.dataIndex]
                    },
                    label: {
                        show: true,
                        position: 'top',
                        textStyle: {
                            color: 'black',
                            fontSize: 16
                        }
                    }

                }
            }
        }]
    };
    var myChart = echarts.init(document.querySelector('#viewDashBoard'));
    myChart.setOption(option);
}

function Device() {

    var option = {
        title: {
            text: '站点访问设备',
            left: 'center'
        },
        tooltip: {
            trigger: 'item',
            formatter: '{a} <br/>{b} : {c} ({d}%)'
        },
        series: [{
            name: '访问设备',
            type: 'pie',
            radius: '55%',
            center: ['50%', '50%'],
            data: [{
                    value: monitorViews.device[0],
                    name: '移动端',
                    itemStyle: {
                        color: "#61a0a8"
                    }
                },
                {
                    value: monitorViews.device[1],
                    name: 'PC端',
                    itemStyle: {
                        color: "#d48265"
                    }
                },
            ],
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },
            itemStyle: {
                normal: {
                    label: {
                        show: true,
                        formatter: '{b} : {c} ({d}%)'
                    },
                    labelLine: {
                        show: true
                    }
                }
            }
        }]
    };
    var myChart = echarts.init(document.querySelector('#deviceDashBoard'));
    myChart.setOption(option);

}