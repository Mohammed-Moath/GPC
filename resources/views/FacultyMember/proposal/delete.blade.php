@if($Proposal->References ==0 && $Proposal->Certified ==0)
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> حذف مقترح المشروع </h4>
                </div>
                {!! Form::open(["url"=>['FN-proposal',$Proposal->id,'delete']]) !!}
                    <div class="modal-body">
                        <div class="alert alert-danger table-responsive"><span class="glyphicon glyphicon-warning-sign"></span> <strong>هل أنت متاكد من حذف المقترح :  </strong> {{ isset($Proposal->ProjectProposalTitle) !=null ?  $Proposal->ProjectProposalTitle : 'لايوجد أي بيانات ليتم عرضها!.' }} </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">حذف ، غير تهائي</button>
                        <button type="submit" class="btn btn-danger" title="حذف هذا المقترح بشكل نهائي"> نعم ، حذف نهائي</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal">الغاء</button>
                    </div>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    @endif