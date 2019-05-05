@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">选手列表</h3>
    </div>

    <form role="form" id="mark-form" name="mark-form" method="post" action="{{ route('review.design') }}">
        @csrf
        <div class="card-body">
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
                                @if (optional($item->review)->design_score)
                                    {{ optional($item->review)->design_score }}
                                @else
                                    <input type="text" name="scores[{{ $item->id }}]" id="scores[{{ $item->id }}]" value="{{ old('scores[' . $item->id . ']', optional($item->review)->design_score) }}" placeholder="教学设计得分" class="form-control">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @unless (optional($items[0]->review)->design_score)
            <div class="card-footer">
                <div class="row justify-content-sm-center">
                    <button type="submit" class="btn btn-success" onclick="return window.confirm('教学设计评分提交后将不可以再修改，请仔细检查评分，无误请点击“确定”，否则请点击“取消”！');">
                        <i class="icon fa fa-marker"></i> 提交评分
                    </button>
                </div>
            </div>
        @endunless
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

            // Use ajax to submit form data
            $.ajax({
                'headers': '{{ csrf_token() }}',
                'url': '{{ route('review.design') }}',
                'type': 'post',
                'data': {
                    '_token': '{{ csrf_token() }}',
                    'dataType': 'json',
                    $(this).attr('name'): $(this).val()
                },
                'beforeSend': function() {
                    $(this).after('<p>保存中......</p>');
                },
                'success': function(data) {
                    if (data.message === 'success'){
                        $(this).after('<p>保存成功</p>');
                    } else {
                        $(this).after('<p>保存失败</p>');
                    }
                }
            })
            .fail(function(jqXHR) {
                if (422 == jqXHR.status) {
                    $.each(jqXHR.responseJSON, function(key, value) {
                        $(this).after('<p>' + value + '</p>');
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
