<p class="lead">
    Our Menu List
        <a href="/admin/editlist" class="btn btn-large btn-error">Show Editable Items!</a>

</p>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Main Category</th>
        <th>Target Audience</th>
        <th>Contact</th>
        <th>Date</th>
        <th>Price Range</th>
        <th>Picture</th>
    </tr>
    {places}
    <tr>
        <td>{id}</td>
        <td>{name}</td>
        <td class="span3">{description}</td>
        <td>{main}</td>
        <td>{sub}</td>
        <!--<td>{target}</td>-->
        <td>{contact}</td>
        <td>{date}</td>
        <td>{price}</td>
        <!--<td>{price_range}</td>-->
        <td class="span3"><img src="/data/{pic}" title="{id}"/></td>
    </tr>
    {/places}
</table>
