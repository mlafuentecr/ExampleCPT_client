<?php
    /*
    Template Name: page-template_submit_entry
    */

    get_header(  );
    function checkTitleExist( $pg_title ){
        $posts = get_posts( array('post_type' => 'entries','post_title' =>  $pg_title, ) );
        $title =  $posts[0]->post_title;
        return $title === $pg_title  ? true : false;
    }


    if(empty($_POST['first_name']) && empty($_POST['email'])){
        echo " <br/> Please fill in the fields";
    }else{

        $pg_title = sanitize_text_field($_POST['first_name']);
        $email = sanitize_email($_POST['email']);
        $email = sanitize_email($_POST['email']);
        $Phone = sanitize_email($_POST['Phone']);
        $description = sanitize_email($_POST['description']);
        $random_number = rand(); // Generate a random number

        // Create a new post
        $new_post = array(
            'post_title'   => $pg_title,
            'post_content' => '',
            'post_status'  => 'publish',
            'post_type'    => 'entries',
            'post_author'  => 1, 
            'meta_input'   => array(
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'email'        => $email,
                'Phone'        => $Phone,
                'description'  => $description,
                'competition_id'=> $random_number,
            ),
        );
        
  
          if(!checkTitleExist( $pg_title ))  {
            wp_insert_post($new_post);
            echo ('Your Name is:     '. $pg_title. '<br/>');
            echo ('Your Email is:'   . $email. '<br/>');
            wp_die( $title);
            }else{
                echo ('Already exist     '. $pg_title. '<br/>');
            }

        }

        ?>
 <main class="main_content">
       <form id="myForm" method="POST">

            <div class='row my-3'>
                <label for="first-name" class='col-4'>First Name:</label>
                <input class='col-6' type="text" name="first_name" id="first_name" required>
            </div>
            <div class='row my-3'>
                <label class='col-4'  for="last-name">Last Name:</label>
                <input  class='col-6' type="text" name="last_name" id="last_name" required>
            </div>
            <div class='row my-3'>
                <label class='col-4'  for="email">Email:</label>
                <input  class='col-6' type="email" name="email" id="email" required>
            </div>
            <div class='row my-3'>
                <label class='col-4'  for="Phone">Phone:</label>
                <input  class='col-6' type="tel" name="Phone" id="Phone" required>
            </div>
            <div class='row my-3'>
                <button type="submit" class='submit' type="submit" value="Submit"> Submit </button>  
                <div  class='col-2' ></div>
            </div>

    </form>
    <div id="responseMessage"></div>    

<script>
jQuery(document).ready(function($) {
	jQuery.post(<?php echo admin_url('admin-ajax.php'); ?>, data, function(response) {
		alert('Got this from the server: ' + response);
	});
});
</script>

<?php   get_footer( );       ?>
</main>
