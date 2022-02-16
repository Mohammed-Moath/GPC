<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                <h4 class="modal-title custom_align" id="Heading">حذف المقترح رقم {{$ShowProposal->id}}</h4>
            </div>
            <div class="modal-body"> 
                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span>هل أنت متأكد من حذف المقترح الذي يحمل العنوان : {{ $ShowProposal->ProjectProposalTitle}} ? </div>
                
                </div>
                    <div class="modal-footer ">
            
                    <button type="button" class="btn btn-warning" data-dismiss="modal">حذف ، غير تهائي</button>
                    <a href="{{ url("review/proposal/$ShowProposal->id/destroy") }}"> <type="submit" class="btn btn-danger" title="حذف هذا المقترح بشكل نهائي">حذف ،  تهائي <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></a>
                    <button type="button" class="btn btn-success" data-dismiss="modal">الغاء</button>
               
                    
                </div>
            </div>
        </div>
        <!-- /.modal-content --> 
    </div>
     <!-- /.modal-dialog --> 
</div>

    