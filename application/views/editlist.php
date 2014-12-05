<p class="lead">
    Our Menu List
    <a href="/admin/add" class="btn btn-large btn-primary">Create +</a>
</p>

<div class="row text-center">
    
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
            <th>Edit</th>
            <th>Delete</th>

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
        <td class="span1"><img src="/data/{pic}" title="{id}"/></td>
        <td><a href="/admin/edit3/{id}">Edit</a></td>
        <td><a href="/admin/choice/{id}">-</a></td>
    </tr>
    
    {/places}
    </table>
</div>