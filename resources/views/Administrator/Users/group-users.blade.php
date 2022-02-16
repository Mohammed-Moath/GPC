<!-- Modal -->
<div class="modal fade" id="GroupUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">أختر المجموعة</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {!! Form::open(['url'=>'administrator/users/add','files'=>true]) !!}
      <div class="modal-body">

        <div class="form-check">
          <label class="custom-control custom-radio label_user_group">
            <input id="Administrator" name="group_user" type="radio" value="1" class="custom-control-input">
            <span class="custom-control-indicator"></span>
          </label>
          <label for="Administrator">مدير النظام</label>
        </div>
        <div class="form-check">
          <label class="custom-control custom-radio label_user_group">
            <input id="project_Committee" name="group_user" type="radio" value="2" class="custom-control-input">
            <span class="custom-control-indicator"></span>
          </label>
          <label for="project_Committee">لجنة المشاريع</label>
        </div>
        <div class="form-check">
          <label class="custom-control custom-radio label_user_group">
            <input id="Students" name="group_user" type="radio" value="3" class="custom-control-input">
            <span class="custom-control-indicator"></span>
          </label>
          <label for="Students">الطلاب</label>
        </div>
        <div class="form-check">
          <label class="custom-control custom-radio label_user_group">
            <input id="Faculty_Members" name="group_user" type="radio" value="4" class="custom-control-input">
            <span class="custom-control-indicator"></span>
          </label>
          <label for="Faculty_Members">هيئة التدريس</label>
        </div>
        <div class="form-check ">
          <label class="custom-control custom-radio label_user_group">
            <input id="Guests" name="group_user" type="radio" value="5" class="custom-control-input">
            <span class="custom-control-indicator"></span>
          </label>
          <label for="Guests">زوائر</label>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
        <button type="submit" class="btn btn-primary">متابعة</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>