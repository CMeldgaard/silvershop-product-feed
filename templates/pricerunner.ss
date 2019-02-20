<?xml version="1.0"?>
<products>
	<% loop $Items %>
		<% if $Variations %>
			<% loop $Variations %>
				<% if not $RemoveFromProductFeed %>
                    <product>
                        <productName>$Up.Title - $Title</productName>
                        <productDescription>$Up.Content.Summary</productDescription>
                        <productSKU>$InternalItemID</productSKU>
                        <imageURL>{$Up.Image.AbsoluteLink}</imageURL>
                        <productURL>$Up.AbsoluteLink</productURL>
                        <productPrice>$Price $Top.Currency</productPrice>
                        <productEAN>$EAN</productEAN>
						<% if $hasAvailableStock %><productAvailability>In Stock</productAvailability><% end_if %>
						<% if not $hasAvailableStock %><productAvailability>Out of Stock</productAvailability><% end_if %>
						<% if $Up.PricerunnerProductCategory.exists %><productCategory>$Up.PricerunnerProductCategory.Title</productCategory><% end_if %>
                        <productDeliveryTime><% if $Up.PricerunnerDeliveryTime %>$Up.PricerunnerDeliveryTime<% else %>$Top.DefaultDelivery<% end_if %></productDeliveryTime>
                    </product>
				<% end_if %>
			<% end_loop %>
		<% else %>
            <product>
                <productName>$Title</productName>
                <productDescription>$Content.Summary</productDescription>
                <productSKU>$InternalItemID</productSKU>
                <imageURL>$Image.AbsoluteLink</imageURL>
                <productURL>$AbsoluteLink</productURL>
                <productPrice>$Price $Top.Currency</productPrice>
                <productEAN>$EAN</productEAN>
				<% if $hasAvailableStock %><productAvailability>In Stock</productAvailability><% end_if %>
				<% if not $hasAvailableStock %><productAvailability>Out of Stock</productAvailability><% end_if %>
				<% if $PricerunnerProductCategory.exists %><productCategory>$PricerunnerProductCategory.Title</productCategory><% end_if %>
                <productDeliveryTime><% if $PricerunnerDeliveryTime %>$PricerunnerDeliveryTime<% else %>$Top.DefaultDelivery<% end_if %></productDeliveryTime>
            </product>
		<% end_if %>
	<% end_loop %>
</products>