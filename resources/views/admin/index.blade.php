@extends('admin.lay')

@section('content')
<script>
    window.location.hash = "";

    // Again because Google Chrome doesn't insert
    // the first hash into the history
    window.location.hash = ""; 

    window.onhashchange = function(){
        window.location.hash = "";
    }
</script>
@endsection
