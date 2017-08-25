<div class="form-group">
    {!! Form::label('title','Title:') !!}
    {!! Form::text('title',null,['class'=>'form-control']) !!}
</div>
<div class="form-group">
    {{--{!! Form::label('body','Body:') !!}--}}
    <div class="editor">
        {!! Form::textarea('body',null,['class'=>'form-control','id'=>'myEditor']) !!}
    </div>
</div>