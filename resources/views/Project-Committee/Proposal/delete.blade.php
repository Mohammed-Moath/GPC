<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fa fa-trash"></i> حذف مقترح </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger table-responsive">هل أنت متأكد من حذف المقترح الذي يحمل العنوان : {{ $Proposal->ProjectProposalTitle}} ؟ </div>
        <small  class="form-text text-muted">
          <i class="fa fa-info-circle"></i> يمكنك فقط حذف المقترح في حالة عدم أختياره من قبل الطلبة.
        </small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ألغاء</button>
        <a href="{{ url("project/committee/proposal/$Proposal->id/delete") }}" type="button" class="btn btn-primary">حذف</a>
      </div>
    </div>
  </div>
</div>