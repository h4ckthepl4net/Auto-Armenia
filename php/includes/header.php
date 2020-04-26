<div class="header_main_container">
    <a href="/" class="home-link">
        <img src="/assets/images/logo.png" class="header-logo">
    </a>
    <div class="navigation-link-container">
        <a href="" class="navigation-link">Վաճառել</a>
        <a href="" class="navigation-link">Գնել</a>
        <a href="" class="navigation-link">Վարձույթ</a>
        <a href="" class="navigation-link">Փնտրել</a>
        <a href="" class="navigation-link">Կապ մեզ հետ</a>
        <a href="" class="navigation-link">Մեր մասին</a>
        <?php if(!isset($_SESSION['logged_in']) || empty($_SESSION['logged_in'])): ?>
            <?php if($_SERVER['REQUEST_URI'] !== '/auth/login'): ?>
            <a href="/auth/login" class="navigation-link">Մուտք</a>
            <?php endif ?>
            <?php if($_SERVER['REQUEST_URI'] !== '/auth/register'): ?>
                <a href="/auth/register" class="navigation-link">Գրանցում</a>
            <?php endif ?>
        <?php endif ?>
    </div>
    <?php if(isset($_SESSION['logged_in']) && !empty($_SESSION['logged_in'])): ?>
        <button class="account-button" material-icon>
            account_circle
        </button>
    <?php endif ?>
</div>
