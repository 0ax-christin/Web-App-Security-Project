$('#translatorTrigger').on('click', () => {
  $('.hasText').each((i, element) => {
    let elementText = $(element).text();
    $.ajax({
      url: "translate.php",
      type: "POST",
      dataType: "json",
      data: { text: `${elementText}` },
      contentType: "application/x-www-form-urlencoded",
      success: (response) => {
        let jsonResp = response;
        $(element).text(jsonResp.text);
      }
     });
  });
})
$('#translatorTrigger2').on('click', () => {
  $('.hasText').each((i, element) => {
    let elementText = $(element).text();
    $.ajax({
      url: "http://website2.webapp.com/translate.php",
      type: "POST",
      dataType: "json",
      data: { text: `${elementText}` },
      contentType: "application/x-www-form-urlencoded",
      success: (response) => {
        let jsonResp = response;
        $(element).text(jsonResp.text);
      }
     });
  });
})
