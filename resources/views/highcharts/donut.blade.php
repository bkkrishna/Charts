@extends('charts::default')


<script type="text/javascript">
$(function () {
    var chart = new Highcharts.Chart({
        chart: {
            renderTo: "{{ $model->id }}",
            @include('charts::_partials.dimension.js')
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: "{{ $model->title }}",
        },
        tooltip: {
            pointFormat: '{point.y} <b>({point.percentage:.1f}%)</strong>'
        },
        plotOptions: {
            pie: {
                innerSize: 225,
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</strong>: {point.y} ({point.percentage:.1f}%)',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            colorByPoint: true,
            data: [
                $i = 0;
                @foreach($model->values as $dta)
                    $e = {{ $model->labels[$i] }};
                    $v = $dta;
                    {
                        name: "{{ $e }}",
                        y: "{{ $v }}"
                    };
                    $i++;
                @endforeach
            ]
        }]
    })
});
</script>

@if(!$model->customId)
    @include('charts::_partials.container.div')
@endif
