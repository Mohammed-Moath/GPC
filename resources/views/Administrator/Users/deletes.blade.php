<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">حذف حساب المستخدم رقم {{$user->id}}</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

         
            <div class="modal-body">
                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> هل انت متأكد من حذف بيانات حساب المستخدم {{$user->username}} </div>

            </div>
            <div class="modal-footer ">
                {!! Form::open(['method'=>'DELETE','url'=>['administrator/users',$user->id,'delete']]) !!}
                <button type="button" class="btn btn-warning" data-dismiss="modal">تجميد</button>
                <button type="submit" class="btn btn-danger" title="حذف هذا الحساب بشكل نهائي"> حذف نهائي</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">الغاء</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>