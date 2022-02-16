@foreach($Meetings as $m)
    <div class="modal fade" id="Approval-{{$m->id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                    <h4 class="modal-title custom_align" id="Heading">  تفاصيل اللقاء رقم : {{ isset($m->NumberOfMeeting) !=null ? $m->NumberOfMeeting : '#'}} </h4>
                </div>
                    <div class="modal-body"> 
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-success"> طباعة</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">الغاء</button>
                    </div>
            </div>
            <!-- /.modal-content --> 
        </div>
        <!-- /.modal-dialog --> 
    </div>
@endforeach   
    