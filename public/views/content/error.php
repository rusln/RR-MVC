<section class="text-center">
    <!--<p class="message">The page that you have requested does not exists</p>-->
    <p class="message label label-warning"><?php echo $this->errorMessage; ?></p>
    <p><img  class="img-circle"src="<?php echo BASE_URL ?>public/assets/jpg/CanYouHearUs.gif" /></p>
    <a href="<?php echo BASE_URL.$this->errorOrigin; ?>"><button>go back</button></a>
</section>
