<!-- Modal -->
<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">تغير كلمة المرور</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::model($user,['method'=>'PATCH','url'=>['administrator/users',$user->id,'update'],'files'=>true]) }}
      <div class="modal-body">

        <div class="form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
          <input  name="password" type="password" require maxlength="250" id="password" class="form-control" placeholder="كلمة المرور"  tilte="كلمة المرور"/>
          <!-- {!! Form::text('password',null,array('required','maxlength'=>'250','id'=>'password','class'=>'form-control','placeholder'=>'كلمة المرور','title'=>'كلمة المرور')) !!} -->
          <span class="masseg_error">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
        <button type="submit" class="btn btn-primary">تغير</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>