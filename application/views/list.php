<div class="header">
    <br />
    <h2>Select by:</h2>
    <br />
    <form action="/home/choice/{choice}" method="post">
        {fmain}
        {fsubmit}
    </form>
</div>

{places}
<div class="row">
    
    <h3>{name}</h3>
    <div class="span5"><a href="{href}/{id}"><img src="/data/{pic}" title="{id}"/></a></div>
    <br />
    
</div>
{/places}