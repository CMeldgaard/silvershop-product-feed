<?xml version="1.0"?>
<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
        <title>$SiteConfig.Title</title>
        <link>$BaseHref</link>
        <description>$SiteConfig.Tagline</description>
		<% loop $Items %>
			<% if $Variations %>
				<% loop $Variations %>
                    <item>
                        <title>$Up.Title - $Title</title>
                        <g:title>$Up.Title - $Title</g:title>
                        <description>$Up.Content.Summary</description>
                        <g:description>$Up.Content.Summary</g:description>
                        <g:id>$InternalItemID</g:id>
                        <link>$Up.AbsoluteLink</link>
                        <g:link>$Up.AbsoluteLink</g:link>
                        <g:image_link>{$Up.Image.AbsoluteLink}</g:image_link>
                        <g:price>$Price</g:price>
                        <g:condition>$Up.GoogleCondition</g:condition>
	                    <g:gtin>$EAN</g:gtin>
	                    <% if $hasAvailableStock %><g:availability>In Stock</g:availability><% end_if %>
	                    <% if not $hasAvailableStock %><g:availability>Out of Stock</g:availability><% end_if %>
	                    <% if $Up.Brand %><g:brand>$Up.Brand</g:brand><% end_if %>
						<% if $Up.GoogleProductCategory.exists %><g:google_product_category>$Up.GoogleProductCategory.GoogleID</g:google_product_category><% end_if %>
                    </item>
				<% end_loop %>
			<% else %>
                <item>
                    <title>$Title</title>
                    <g:title>$Title</g:title>
                    <description>$Content.Summary</description>
                    <g:description>$Content.Summary</g:description>
                    <g:id>$InternalItemID</g:id>
                    <link>$AbsoluteLink</link>
                    <g:link>$AbsoluteLink</g:link>
					<g:image_link>{$Image.AbsoluteLink}</g:image_link>
                    <g:price>$Price</g:price>
                    <g:condition>$GoogleCondition</g:condition>
                    <g:gtin>$EAN</g:gtin>
	                <% if $hasAvailableStock %><g:availability>In Stock</g:availability><% end_if %>
	                <% if not $hasAvailableStock %><g:availability>Out of Stock</g:availability><% end_if %>
	                <% if $Brand %><g:brand>$Brand</g:brand><% end_if %>
					<% if $GoogleProductCategory.exists %><g:google_product_category>$GoogleProductCategory.GoogleID</g:google_product_category><% end_if %>
                </item>
			<% end_if %>
		<% end_loop %>

    </channel>
</rss>