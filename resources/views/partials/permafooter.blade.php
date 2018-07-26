<div class="permafooter">


    <div class="footer-button">
        <a href="/home" class="home-button <?php if ($page == 'home') {
            echo 'on-page';
        } ?>" data-toggle="tooltip" data-placement="top" title="View your FrendGrid">
            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
        </a>


    </div>

    <div class="footer-button">
        <a href="/activity" class="list-button <?php if ($page == 'activity') {
            echo 'on-page';
        } ?>" data-toggle="tooltip" data-placement="top" title="View all recent activity">
            <i class="fa fa-list fa-2x" aria-hidden="true"></i>
        </a>


    </div>

    <div class="footer-button" data-toggle="tooltip" data-placement="top" title="Upload a new post">
        <button type="button" class="btn upload-post-button" data-toggle="modal" data-target="#uploadImage" >
            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
        </button>
    </div>

    <div class="footer-button">
        <a href="/shouts" class="me-button <?php if ($page == 'messages') {
            echo 'on-page';
        } ?>" data-toggle="tooltip" data-placement="top" title="Send messages to friends that disappear once opened">
            @if($_COOKIE['FG_Shoutcount'] > 0)
            <i class="fa fa-bullhorn fa-2x" aria-hidden="true" style="color: #F62E55;"></i>

                {{$_COOKIE['FG_Shoutcount']}}
                @else
                <i class="fa fa-bullhorn fa-2x" aria-hidden="true"></i>
            @endif
        </a>
    </div>

    <div class="footer-button">
        <a href="/me" class="me-button <?php if ($page == 'me') {
            echo 'on-page';
        } ?>" data-toggle="tooltip" data-placement="top" title="Go to your profile">
            <i class="fa fa-user fa-2x" aria-hidden="true"></i>
        </a>

    </div>


</div>