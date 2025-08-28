<div>


<div>
    @if($success)
    <div class="bs-example  col-md-8 offset-md-2" style="display: block">
        <div class="alert alert-success alert-dismissible fade show">
            <p> {{ $success }}</p>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    </div>
    @endif



    <button wire:click="testit">does this component work</button>

</div>

</div>