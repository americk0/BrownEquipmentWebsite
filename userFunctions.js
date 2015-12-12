
/**
 *  redirects the user to the display.php page, passing id via the GET method
 *
 *  @param {number} id - the id of the record to display
 *  @author Ben Watson
 */
function handleRowClick(id){
  //display.php will sanitize inputs for id so there is no need for it here
  window.document.location = "display.php?id=" + id;
}
