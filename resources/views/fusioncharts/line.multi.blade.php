@extends('charts::default')


<script type="text/javascript">
FusionCharts.ready(function () {
    var revenueChart = new FusionCharts({
        type: 'msline',
        renderAt: "{{ $model->id }}",
        @include('charts::_partials.dimension.js')
        dataFormat: 'json',
        dataSource: {
            'chart': {
                'caption': "{{ $model->title }}",
                'yAxisName': "{{ $model->element_label }}",
                'bgColor': '#ffffff',
                'borderAlpha': '20',
                'canvasBorderAlpha': '0',
                'usePlotGradientColor': '0',
                'plotBorderAlpha': '10',
                'rotatevalues': '1',
                'valueFontColor': '#ffffff',
                'showXAxisLine': '1',
                'xAxisLineColor': '#999999',
                'divlineColor': '#999999',
                'divLineIsDashed': '1',
                'showAlternateHGridColor': '0',
                'subcaptionFontBold': '0',
                'subcaptionFontSize': '14'
            },
            'categories': [{
                'category': [
                    @foreach($model->labels as $l)
                        {
                            'label': "{{ $l }}",
                        },
                    @endforeach
                ]
            }],
            'dataset': [
                $i = 0;
                @foreach($model->datasets as $el => $ds)
                    {
                        'seriesname': "{{ $el }}",
                        @if($model->colors and count($model->colors) > $i)
                            'color': "{{ $model->colors[$i] }}",
                        @endif
                        'data': [
                            @foreach($ds['values'] as $v)
                                {
                                    'value': "{{ $v }}"
                                },
                            @endforeach
                        ]
                    },
                    $i++;
                @endforeach
            ]
        }
    }).render()
});
</script>

<div id="{{ $model->id }}"></div>
