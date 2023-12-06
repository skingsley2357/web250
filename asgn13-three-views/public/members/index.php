<?php require_once('../../private/initialize.php'); ?>
<?php require_login(); ?>
<?php

var_dump($session->user_level); // Add this line for debugging
var_dump($session->is_logged_in()); // Add this line for debugging
// Find all members
$members = Member::find_all();
  
?>
<?php $page_title = 'Members'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">
  <div class="admins listing">
    <h1>Members</h1>

    <?php if ($session->user_level == 3) : ?>
    <div class="actions">
      <a class="action" href="<?php echo url_for('/members/new.php'); ?>">Add Member</a>
    </div>
    <?php endif; ?>

  	<table class="list">
      <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Username</th>
        <?php if ($session->user_level == 3) : ?>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <?php endif; ?>
      </tr>

      <?php foreach($members as $member) { ?>
        <tr>
          <td><?php echo h($member->id); ?></td>
          <td><?php echo h($member->first_name); ?></td>
          <td><?php echo h($member->last_name); ?></td>
          <td><?php echo h($member->email); ?></td>
          <td><?php echo h($member->username); ?></td>
          <?php if ($session->user_level == 3) : ?>
          <td><a class="action" href="<?php echo url_for('/members/show.php?id=' . h(u($member->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/members/edit.php?id=' . h(u($member->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/members/delete.php?id=' . h(u($member->id))); ?>">Delete</a></td>
          <?php endif; ?>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
