@if(count($Calendar->appointments) !=0)
    @foreach($Calendar->appointments as $a)
        <!-- Modal -->
        <div class="modal fade" id="appointments-{{$a->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="appointments-{{$a->id}}"><i class="fa fa-trash"></i> حذف الموعد</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert">
                    <i class="fa fa-warning"></i>   هل انت متأكد من حذف موعد  : {{ isset($a->name) !=null ? $a->name : ''}}
                </div>
                <small  class="form-text text-muted">
                    <i class="fa fa-exclamation-circle"></i> يمكنك ققط حذف الموعد قبل تاريخ بداية نشاطه.
                </small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <a type="button" class="btn btn-primary" href="{{url("/project-committee/appointments/$a->id/delete")}}">حذف</a>
            </div>
            </div>
        </div>
        </div>
    @endforeach
@endif
                       