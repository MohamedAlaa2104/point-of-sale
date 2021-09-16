{{--@can('edit categories')--}}
    <a class="link-icon-edit" href="{{route('dashboard.contactus.show', $row->id)}}"><i class="fe fe-eye"></i></a>
{{--@endcan--}}
{{--@can('delete categories')--}}
    <a class="link-icon-delete" data-target="#modaldemo{{$row->id}}" data-toggle="modal" href="#"><i class="las la-trash-alt"></i></a>
{{--@endcan--}}


<div class="modal" id="modaldemo{{$row->id}}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button> <i class="icon icon ion-ios-close-circle-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger mg-b-20">@lang('dashboard.are-you-sure-to-delete-this')</h4>
                <p class="mg-b-20 mg-x-20">@lang('dashboard.you-can-not-restore-it-again')</p><a aria-label="Close" onclick="event.preventDefault(); document.getElementById('delete-form-{{$row->id}}').submit();"  class="btn ripple btn-danger pd-x-25" data-dismiss="modal" type="button">@lang('dashboard.yes')</a>
            </div>
        </div>
    </div>
    <form id="delete-form-{{$row->id}}" action="{{route('dashboard.contactus.destroy', $row->id)}}" method="POST">
        @method('DELETE')
        @csrf
    </form>
</div>









