<?php

/**
 * Disables REFILL function in WPCF7 if Recaptcha is in use
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( class_exists( 'WPCF7_RECAPTCHA' ) ) {
		$service = WPCF7_RECAPTCHA::get_instance();

		if ( ! $service->is_active() ) {
			//return;
		}

		wp_add_inline_script( 'contact-form-7', 'wpcf7.cached = 0;', 'before' );
	}
} );

add_action( 'wpcf7_before_send_mail', function ( $cf7 ) {
	/** @var WPCF7_ContactForm $cf7 */
	$response = false;

	$form  = WPCF7_Submission::get_instance();
	$email = trim( $form->get_posted_data( 'email' ) );

	if ( filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {

		// Contact
		if ( in_array( $cf7->id(), [] ) ) {
			$subject = 'Thanks for contacting';
			$message = "Thanks for contacting our company. Our team will contact you. Have a nice day.\n\nBest Regards";

			$response = wp_mail( $email, $subject, $message, [
				'From: Dudka Agency <contact@dudka.agency>',
			] );
		}
	}

	return $response;
} );
