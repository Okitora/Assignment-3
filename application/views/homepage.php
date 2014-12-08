{places}
<div class="row">
    <div class="span11">
        <h2>{name}</h2>
    </div>
    
    <div class="span5">
    <a href="/data/{pic1}" data-lightbox="gallery" data-title={pic1} title="{id}_{pic1}"><img class="span5" src="/data/{pic1}" alt="" /></a>
    <br>
        <a href="/data/{pic2}" data-lightbox="gallery" data-title={pic2} title="{id}_{pic2}"><img class="span5" src="/data/{pic2}" alt="" /></a>
        <br>
    <a href="/data/{pic3}" data-lightbox="gallery" data-title={pic3} title="{id}_{pic3}"><img class="span5" src="/data/{pic3}" alt="" /></a>
    <br/>
    </div>
    <tr>
    <div class="span7">
        <p>
            {description}
        </p>
        <table>
            <tr>
                <td><h5>Main Category </h5></td>
                <td><h5>Target Audience </h5></td>
                <td><h5>Price Range </h5></td>
                <td><h5>Contact </h5></td> 
                <td><h5>Price </h5></td>
                <td><h5>Date </h5> </td>
            </tr>
            <tr>
                <td>{main_id}</td>
                <td>{target}</td>
                <td>{price_range}</td>
                <td>{contact}</td>
                <td>{price}</td>
                <td>{date}</td>    
            </tr>
        </table>
        
            {specifics}
            
        <h5>{firstName}: {firstVal}</h5>
            
            
            
        <h5>{secondName}: {secondVal}</h5>
            
            
            {/specifics}
        
    </div>
    </tr>
</div>
{/places}

