@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">选手列表</h3>
    </div>

    <form role="form" id="mark-form" name="mark-form" method="post" action="{{ route('review.design') }}">
        @csrf
        <div class="card-body">
            <div class="text-danger" id="status"></div>
            <table id="itemsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">选手编号</th>
                        <th scope="col">教学大纲</th>
                        <th scope="col">教学设计</th>
                        <th scope="col">得分</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if (!is_null($item->document))
                                    <a href="{{ asset('vendor/pdfjs/web/viewer.html?file=' . asset($item->document->syllabus)) }}">教学大纲</a>
                                @endif
                            </td>
                            <td>
                                @if (!is_null($item->document))
                                    <a href="{{ asset('vendor/pdfjs/web/viewer.html?file=' . asset($item->document->design)) }}">教学设计</a>
                                @endif
                            </td>
                            <td>
                                @if (optional($item->review)->design_confirmed)
                                    {{ optional($item->review)->design_score }}
                                @else
                                    <input type="text" name="scores[{{ $item->id }}]" id="scores[{{ $item->id }}]" data-id="{{ $item->id }}" value="{{ old('scores[' . $item->id . ']', optional($item->review)->design_score) }}" placeholder="教学设计得分" class="form-control" required>
                                    <div id="status{{ $item->id }}"></div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if (App\Entities\Review::whereMarkerId(Auth::id())->whereDesignConfirmed(false)->where('year', '=', date('Y'))->count())
            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    <button type="submit" class="btn btn-success" onclick="return window.confirm('教学设计评分提交后将不可以再修改，请仔细检查评分，无误请点击“确定”，否则请点击“取消”！');">
                        <i class="icon fa fa-marker"></i> 提交评分
                    </button>
                </div>
            </div>
        @endif
    </form>
</div>
@stop

@push('scripts')
<script>
$(function() {
    $('td').on('click', function() {
        $(this).children('input').select();
    });
    $('td').on({
        'click': function() {
            $(this).select();
        },
        'change': function() {
            var id = $(this).attr('data-id');
            var scores = [];
            scores[id] = $(this).val();

            // Use ajax to submit form data
            $.ajax({
                'headers': '{{ csrf_token() }}',
                'url': '{{ route('review.design') }}',
                'type': 'post',
                'dataType': 'json',
                'data': {
                    '_token': '{{ csrf_token() }}',
                    'scores[]': scores
                },
                'traditional': true,
                'beforeSend': function() {
                    $('#status' + id).removeClass();
                    $('#status' + id).text('保存中......').addClass('text-info');
                },
                'success': function(data) {
                    if (data.message === 'success'){
                        $('#status' + id).removeClass();
                        $('#status' + id).text('保存成功').addClass('text-success');
                    } else {
                        $('#status' + id).removeClass();
                        $('#status' + id).text('保存失败').addClass('text-danger');
                    }
                }
            })
            .fail(function(jqXHR) {
                if (422 == jqXHR.status) {
                    $.each(jqXHR.responseJSON.errors, function(key, value) {
                        $('#status' + id).removeClass();
                        $('#status' + id).text(value).addClass('text-danger');
                    });
                }
            });
        },
        'keypress': function(e) {
            // Enter pressed
            if (e.keyCode == 13) {
                var inputs = $(this).parents('table').find('input');
                var idx = inputs.index(this);

                if (idx == inputs.length - 1) {
                    inputs[0].select();
                } else {
                    inputs[idx + 1].focus();
                    inputs[idx + 1].select();
                }

                // $(this).closest('form').submit();
                return false;
            }
        }
    }, 'input');
});
</script>
@endpush
