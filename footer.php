    <?php if (pll_current_language( 'name' ) == 'Ελληνικά'){ ?>
        <?php echo do_shortcode('[elementor-template id="2055"]'); ?>
    <?php } else { ?>
        <?php echo do_shortcode('[elementor-template id="307"]'); ?>
    <?php } ?>

</div>

<?php wp_footer(); ?>
<script>
    // $('.nav__sub').prepend('<li class="nav__item"><a class="nav__link sub__close" href="#"><i class="fas fa-chevron-left"></i> Back</a></li>');

// Close out sub menu
$('.sub__close, .c-hamburger').click(function(e) {
	e.preventDefault();
    $('.nav__sub').removeClass('is-active');
	// $(this).parent().parent().removeClass('is-active');
});

// Trigger sub menu
$(document).on('click','.nav__link',function(e){
    e.preventDefault();
    // console.log('sdfdf',e);
    // $('.megamenu-wrapper.m-parent-menu').addClass('d-none');
    // $('.megamenu-wrapper.m-child-menu').addClass('d-blk');
	$('.nav__sub').addClass('is-active');
});
// $('.nav__link').click(function(e) {

// });
</script>

</body>
</html>