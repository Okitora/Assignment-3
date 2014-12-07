<p class="lead">
    Our Menu List
        <a href="/admin/editlist" class="btn btn-large btn-error">Show Editable Items!</a>

</p>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Main Category</th>
        <th>Target Audience</th>
        <th>Price Range</th>
        <th>Specific Details</th>
        <th>Pictures</th>
    </tr>
    {places}
    <tr>
        <td>{id}</td>
        <td>{name}</td>
        <td>{main}</td>
        <td>{target}</td>
        <td>{price_range}</td>
        
        <td>{firstName}: {firstVal}
            <br>
            {secondName}: {secondVal}
        </td>
        
        <td class="span1"><img src="/data/{pic1}" title="{id}_{pic1}"/></td>
        <td class="span1"><img src="/data/{pic2}" title="{id}_{pic2}"/></td>
        <td class="span1"><img src="/data/{pic3}" title="{id}_{pic3}"/></td>
    </tr>
    
    {/places}
</table>
