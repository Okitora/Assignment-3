{places}
<div class="row">
    <div class="span11">
        <h2>{name}</h2>
    </div>
    
    <a href="/data/{pic1}" title="{id}_{pic1}"><img class="span5" src="/data/{pic1}" alt="" /></a>   
    <a href="/data/{pic2}" title="{id}_{pic2}"><img class="span5" src="/data/{pic2}" alt="" /></a>
    <a href="/data/{pic3}" title="{id}_{pic3}"><img class="span5" src="/data/{pic3}" alt="" /></a>
    
    <div class="span7">
        <p>
            {description}
        </p>
        <table>
            <tr>
                <td><h5>Main Category:</h5></td>
                <td><h5>Target Audience:</h5></td>
                <td><h5>Price Range:</h5></td>
                <td><h5>Contact:</h5></td> 
                <td><h5>Price:</h5></td>
                <td><h5>Date:</h5> </td>
            </tr>
            <tr>
                <td>{main_id}</td>
                <td>{target}</td>
                <td>{price_range}</td>
                <td>{contact}</td>
                <td>{price}</td>
                <td>{date}</td>    
            </tr>
            <br>
            <br>
            {specifics}
            <tr>
                <td><h5>{firstName}</h5></td>
                <td><h5>{secondName}</h5></td>
            </tr>
            <tr>
                <td>first:{firstVal}</td>
                <td>second:{secondVal}</td>
            </tr>
            {/specifics}
        </table>
        <br/>
    </div>
 
</div>
{/places}

