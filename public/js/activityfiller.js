$(function() {
	$('.footer-logo').click(function() {
		$('input[name=doen').prop('checked', true);
		$('input[name=beleven').prop('checked', true);
		$('input[name=name]').val('Item');
		$('input[name=organization]').val('Organisatie');
		$('input[name=phone]').val('0612345678');
		$('textarea[name=short_desc]').val('Lorem ipsum dolor sit amet, consectetur adipisicing elit.');
		$('textarea[name=long_desc]').val('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto voluptas sed impedit atque error incidunt officia repellat quasi assumenda animi perspiciatis, possimus a voluptate ratione autem asperiores expedita, hic qui.');
		$('input[name=address]').val('Address 85');
		$('input[name=zipcode]').val('2013AA');
		$('input[name=city]').val('City');
		$('input[name=latitude]').val(52.403014);
		$('input[name=longitude]').val(4.686652);
		$('input[name=website_url]').val('http://www.example.com/');
		$('input[name=facebook_url]').val('http://www.facebook.com/');
		$('input[name=twitter_url]').val('http://www.twitter.com/');

		$('textarea[name=description]').val('Lorem ipsum dolor sit amet, consectetur adipisicing elit.');
		$('input[name=start]').val('2015-10-31 13:00:00');
		$('input[name=end]').val('2015-10-31 15:00:00');
	})

    $(".saveactivity").click(function(){
        var $fileUpload = $(".activityfiles");
        if (parseInt($fileUpload.get(0).files.length)>5){
         	alert("U kunt maximaal 5 afbeeldingen uploaden");
         	return false;
        }
    });
})