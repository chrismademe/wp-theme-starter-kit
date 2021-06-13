    <?php get_template_part( 'template-parts/edit-page-button' ); ?>

    <?php wp_footer(); ?>

    <?php /* Cookie Consent 😴  */ ?>
    <cookie-consent-banner hidden>
        <p><?php echo get_field_fallback('cookie_consent_message', 'We use cookies to provide the best experience.', 'option') ?></p>
    </cookie-consent-banner>
    <script type="module" src="https://unpkg.com/simple-cookie-consent-banner/cookie-consent-banner.js"></script>

</body>
</html>