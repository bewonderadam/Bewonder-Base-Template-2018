<?php
/**
 * Template Name: Rubix Event Form
 */
get_header(); ?>
<section id="page-header-container">
  <div class="page-header-inner">
    <div class="title-container">
      <div class="title-inner">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>
  </div>
</section>
<section id="page-container">
  <div class="page-container-inner">
    <div class="newsletter-content">
      <?php the_post_thumbnail();
    	the_content();
    	$acc_name = get_field( 'account_name' );
    	$list_name = get_field( 'list_name' );
    	$success_page = get_field( 'form_submission_success_page' );
    	$old_date = date('Y-m-d');
      $new_date = date('Y-m-d', strtotime('+1095 days'));	?>
    	<form id="rubixEventForm" action="https://response.pure360.com/interface/list.php" METHOD="post">
      	<input type="hidden" name="accName" VALUE="<?php echo $acc_name; ?>"/>
      	<input type="hidden" name="listName" VALUE="<?php echo $list_name; ?>"/>
      	<input type="hidden" name="fullEmailValidationInd" VALUE="Y"/>
      	<input type="hidden" name="doubleOptin" VALUE="false"/>
      	<input type="hidden" name="successUrl" VALUE="<?php echo $success_page; ?>"/>
      	<input type="hidden" name="errorUrl" VALUE=""/>
        <input type="hidden" name="sign_up_date" value="<?php echo $old_date; ?>" />
      	<input type="hidden" name="signUpSource" value="Competition"/>
        <input type="hidden" name="sign_up_campaign" value="Opted In"/>
        <input type="hidden" name="expiry_date" value="<?php echo $new_date; ?>"/>
        <div class="field">
          <label>Title</label>
          <select name="title">
            <option name="title" value="Mr">Mr</option>
            <option name="title" value="Mrs">Mrs</option>
            <option name="title" value="Miss" />Miss</option>
            <option name="title" value="Ms.">Ms.</option>
            <option name="title" value="Other"/>Other</option>
          </select>
        </div>
      	<div class="field">
          <label>First Name:</label>
          <input type="text" placeholder="First Name" name="firstName"/>
        </div>
      	<div class="field">
          <label>Last Name:</label>
          <input type="text" placeholder="Last Name" name="lastName"/>
        </div>
      	<div class="field">
          <label>Email: </label>
          <input type="email" placeholder="Email" name="email" required />
        </div>
      	<div class="field checkbox">
        	<label class="title">I AM INTERESTED IN...</label>
        	<input type="checkbox" value="Offers" name="interests[]"/> <label>Offers</label>
        	<input type="checkbox" value="Events" name="interests[]"/> <label>Events</label>
          <input type="checkbox" value="Food and Drink" name="interests[]"/> <label>Food & Drink</label>
          <input type="checkbox" value="Fashion" name="interests[]"/> <label>Fashion</label>
        	<input type="checkbox" value="Kids" name="interests[]"/> <label>Kids</label>
          <input type="checkbox" value="Competitions" name="interests[]"/> <label>Competitions</label>
      	</div>
    		<?php if( have_rows('additional_fields') ) :
    			$count = 1;
    			while( have_rows('additional_fields') ) : the_row();
    				$typeOfField = get_sub_field('type_of_field');
    				$fieldLabel = get_sub_field('field_label');
    				$options = get_sub_field('options');
    				if($typeOfField == 'Text') : ?>
    					<div class="field">
    						<label><?php echo $fieldLabel; ?></label>
    						<input type="text" placeholder="<?php echo $fieldLabel; ?>" name="customField<?php echo $count; ?>" />
    					</div>
    				<?php elseif($typeOfField == 'Textarea') : ?>
    					<div class="field">
    						<label><?php echo $fieldLabel; ?></label>
    						<textarea name="customField<?php echo $count; ?>"></textarea>
    					</div>
    				<?php elseif($typeOfField == 'Checkbox') : ?>
    					<div class="field checkbox">
    						<label class="title"><?php echo $fieldLabel; ?></label>
    						<?php if( have_rows('options') ) :
    							while( have_rows('options') ) : the_row();
    								$optionLabel = get_sub_field('option_label'); ?>
    								<input type="checkbox" value="<?php echo $optionLabel; ?>" name="customField<?php echo $count; ?>[]" /> <label><?php echo $optionLabel; ?></label>
    							<?php endwhile;
    						endif; ?>
    					</div>
    				<?php elseif($typeOfField == 'Radio Button') : ?>
    					<div class="field radio-button">
    						<label class="title"><?php echo $fieldLabel; ?></label>
    						<?php if( have_rows('options') ) :
    							while( have_rows('options') ) : the_row();
    								$optionLabel = get_sub_field('option_label'); ?>
    								<input type="radio" value="<?php echo $optionLabel; ?>" name="customField<?php echo $count; ?>[]" /> <label><?php echo $optionLabel; ?></label>
    							<?php endwhile;
    						endif; ?>
    					</div>
    				<?php endif;
    				$count++;
    			endwhile;
    		endif; ?>
    		<div class="field opt-in checkbox">
    			<input type="checkbox" name="sign_up_campaign" value="Opted In" id="sign-up-campaign" /><label for="sign-up-campaign"><?php echo get_field( 'opt_in_text' ); ?></label>
    		</div>
    		<script src="https://www.google.com/recaptcha/api.js"> </script>
    		<div class="g-recaptcha" data-sitekey="6Lda1BAUAAAAABeemGvQod8rVNQQUSM2y9pFK_gS"> </div>
      	<input class="button" type="submit" value="Sign up" />
    	</form>
    </div>
  </div>
</section>
<?php get_footer(); ?>
