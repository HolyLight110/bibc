@if (isset($_SESSION['success']))
    <div class="alert alert-success alert-dismissible fade show" role="alert">

        {{$_SESSION['success']}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['success']) ?>
@endif

@if (isset($_SESSION['info']))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{$_SESSION['info']}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['info']) ?>
@endif

@if (isset($_SESSION['warning']))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{$_SESSION['warning']}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['warning']) ?>
@endif

@if (isset($_SESSION['danger']))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{$_SESSION['danger']}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['danger']) ?>
@endif

@if (isset($_SESSION['message']))
    <div class="alert alert-teal alert-dismissible fade show" role="alert">
        {{$_SESSION['message']}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['message']) ?>
@endif