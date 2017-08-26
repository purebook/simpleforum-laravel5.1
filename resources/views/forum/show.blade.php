@extends('app')

@section('content')
    {{--<link rel="stylesheet" href="/css/bootstrap.css">--}}

    <div class="jumbotron" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <div class="container">
         <div class="media">
           <div class="media-left">
               <a href="#">
                   <img class="media-object img-circle" alt="64x64" src="{{ $discussion->user->avatar }}" style="width: 64px;height: 64px;">
               </a>

           </div>
           <div class="media-body">
               <h4 class="media-heading">{{ $discussion->title }}
                   @if(Auth::check() && Auth::user()->id == $discussion->user_id)
                       <a class="btn btn-primary btn-lg pull-right" href="/discussions/{{ $discussion->id }}/edit"
                          role="button">修改该贴 »</a>
                   @endif
               </h4>
                {{ $discussion->user->name }}
           </div>

         </div>
    </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-md-9" role="main" id="post">
            <div class="blog-post">
                {!! $html !!}
            </div>
            <hr>
            @foreach($discussion->comments as $comment)
                 <div class="media">
                   <div class="media-left">
                       <a href="#">
                           <img class="media-object img-circle" alt="64x64" src="{{$comment->user->avatar}}" style="width: 64px;height: 64px;">
                       </a>

                   </div>
                   <div class="media-body">
                       <h4 class="media-heading">{{$comment->user->name}}</h4>
                       {{ $comment->body }}

                   </div>
               </div>
            @endforeach
@if(Auth::check())
                <div class="media" v-for="comment in comments">
                    <div class="media-left">
                        <a href="#">
                            <img :src="comment.avatar" class="media-object img-circle" alt="64x64" style="width: 64px;height: 64px;">
                        </a>

                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">@{{comment.name}}</h4>
                        @{{ comment.body }}

                    </div>
                </div>
            <hr>
                  {!! Form::open(['url'=>'/comments','v-on:submit'=>'onSubmitForm']) !!}
                  {!! Form::hidden('discussion_id',$discussion->id) !!}
                    <div class="form-group">
                        {!! Form::textarea('body',null,['class'=>'form-control','v-model'=>'newComment.body']) !!}
                    </div>
                     <div>
                         {!! Form::submit('发表评论',['class'=>'btn btn-success pull-right']) !!}
                     </div>
                    {!! Form::close() !!}
            @else
                <hr>
                <a href="/user/login" class="btn btn-block btn-success">登录参与评论</a>
@endif
        </div>
        </div>
    </div>
    @if(Auth::check())
         <script>
    Vue.http.headers.common['X-CSRF-TOKEN']=document.querySelector('#token').getAttribute('value');
    Vue.http.options.emulateJSON = true;
    new Vue({
        el:'#post',
        data:{
            comments:[],
            newComment:{
                name:'{{Auth::user()->name}}',
                avatar:'{{Auth::user()->avatar}}',
                body:''
            },
            newPost:{
                discussion_id:'{{$discussion->id}}',
                user_id:'{{Auth::user()->id}}',
                body:''
            }
        },
        methods:{
            onSubmitForm:function(e){
                e.preventDefault();
                var comment=this.newComment;
                var post=this.newPost;
                post.body=comment.body;
                this.$http.post('/comments', post).then(function(){//{url("/comments")}
                    this.comments.push(comment);
                });
                this.newComment={
                    name:'{{Auth::user()->name}}',
                    avatar:'{{Auth::user()->avatar}}',
                    body:''
                };
            }
        }
    })
    </script>
    @endif
@stop

