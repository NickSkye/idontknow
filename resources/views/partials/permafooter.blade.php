<div class="permafooter">


    <div class="footer-button">

        <a href="/messages" class="me-button <?php if ($page == 'messages') {
            echo 'on-page';
        } ?>">
            <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
        </a>
    </div>

    <div class="footer-button">
        <a href="/me" class="me-button <?php if ($page == 'me') {
            echo 'on-page';
        } ?>">
            <i class="fa fa-user fa-2x" aria-hidden="true"></i>
        </a>
    </div>

    <div class="footer-button">
        <button type="button" class="btn upload-button" data-toggle="modal" data-target="#uploadImage">
            <i class="fa fa-plus fa-2x" aria-hidden="true"></i>
        </button>
    </div>

    <div class="footer-button">
        <a href="/" class="home-button <?php if ($page == 'home') {
            echo 'on-page';
        } ?>">
            <i class="fa fa-home fa-2x" aria-hidden="true"></i>
        </a>
    </div>

    <div class="footer-button">
        <a href="/activity" class="list-button <?php if ($page == 'activity') {
            echo 'on-page';
        } ?>">
            <i class="fa fa-list fa-2x" aria-hidden="true"></i>
        </a>
    </div>


</div>