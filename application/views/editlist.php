<p class="lead">
    Our Menu List
    <a href="/admin/add" class="btn btn-large btn-primary">+</a>
</p>

<div class="row text-center">
    
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Main Category</th>
            <th>Sub Category</th>
            <th>Contact</th>
            <th>Date</th>
            <th>Price</th>
            <th>Picture</th>

        </tr>
        {places}
    
        <tr>
        <td>{id}</td>
        <td>{name}</td>
        <td class="span2">{description}</td>
        <td>{main}</td>
        <td>{sub}</td>
        <td>{contact}</td>
        <td>{date}</td>
        <td>{price}</td>
        <td class="span4 offset1"><img src="/data/{pic}" title="{id}"/></td>
        <td class="span1"><a href="/admin/edit3/{id}">Edit</a></td>
        <td><a href="/admin/choice/{id}">-</a></td>
    </tr>
    
    {/places}
    </table>
</div>