// $Id: notifications_comment.js,v 1.1.2.1 2010/03/25 11:54:46 jareyero Exp $
if (Drupal.jsEnabled) {
  $(document).ready(function() {
    $("#edit-notifications-comment-notify-type-1").bind("click", function() {
      if ($("#edit-notifications-comment-notify").attr("checked", false)) {
        // Auto-notification not checked - do it for them.
        $("#edit-notifications-comment-notify").attr("checked",true);
      }
    });
    $("#edit-notifications-comment-notify-type-2").bind("click", function() {
      if ($("#edit-notifications-comment-notify").attr("checked", false)) {
        // Auto-notification not checked - do it for them.
        $("#edit-notifications-comment-notify").attr("checked",true);
      }
    });
  });
}
