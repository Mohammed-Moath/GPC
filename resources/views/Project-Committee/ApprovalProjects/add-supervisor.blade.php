<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">أضافة مشرف الى المجموعة</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        {!! Form::open(["url"=>"project-committee/add/supervisor/$Proposal->id"]) !!} 
            <div class="modal-body {{ $errors->has('Supervisor') ? ' has-error' : '' }}">
                <select title="أختيار المشرف لهذه المجموعة" id="Supervisor" class="form-control" name="Supervisor" >
                    <option >-- حدد المشرف من هنا --</option> 
                    @foreach(Supervisor() as $S)
                        <option value="{{ isset($S->FunctionalNumber) !=null ? $S->FunctionalNumber :'لايوجد أي بيانات لعرضها!.' }}">{{ isset($S->users->Name) !=null ? $S->users->Name : 'لاتوجد أي بيانات لعرضها!.'}}</option>
                    @endforeach
                </select>
                @if ($errors->has('Supervisor'))
                    <span class="help-block">
                        <strong>{{ $errors->first('Supervisor') }}</strong>
                    </span>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-primary">أضافة</button>
            </div>
        {!! Form::close() !!}  
    </div>
  </div>
</div>


