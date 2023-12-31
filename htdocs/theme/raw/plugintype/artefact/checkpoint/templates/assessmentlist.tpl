<!-- The "feedbacktable" class is used as an identifier by Javascript -->
<div class="list-group list-group-lite list-group-top-border">
{foreach from=$data item=item}
    <div id="assessment{$item->id}" class="comment-item list-group-item {cycle name=rows values='r0,r1'} {if $item->attachments}has-attachment{/if} {if $item->private}draft{/if}">
        <div class="flex-row">
            <div class="usericon-heading flex-title flex-row">
                <div class="float-start">
                    <span class="user-icon user-icon-30" role="presentation" aria-hidden="true">
                    {if $item->author && !$item->author->deleted}
                        <img src="{profile_icon_url user=$item->author maxheight=30 maxwidth=30}" valign="middle" alt="{str tag=profileimagetext arg1=$item->author|display_default_name}"/>
                    {else}
                        <img src="{profile_icon_url user=null maxheight=30 maxwidth=30}" valign="middle" alt="{str tag=profileimagetextanonymous}"/>
                    {/if}
                    </span>
                </div>
                <div class="flex-title">
                    <h3 class="list-group-item-heading text-inline">
                        {if $item->author && !$item->author->deleted}
                        <a href="{$item->author->profileurl}">
                            <span>{$item->author|display_name}</span>
                        </a>
                        {elseif $item->author && $item->author->deleted}
                        <span>{$item->author|full_name}</span>
                        {else}
                        <span>{$item->authorname}</span>
                        {/if}

                        <br />

                        <span class="postedon text-small detail">
                        {$item->date}
                        {if $item->updated}
                            <p class="metadata">[{str tag=Updated}: {$item->updated}]</p>
                        {/if}
                        </span>
                    </h3>
                </div>
                <div class="flex-controls">
                    <!-- The "assessment-item-buttons" class is used as an identifier by Javascript -->
                    <div class="btn-group btn-group-top assessment-item-buttons">
                        {if $item->editlink}
                            {$item->editlink|safe}
                        {/if}
                        {if $item->deleteform}
                            {$item->deleteform|safe}
                        {/if}
                    </div>
                </div>
            </div>
        </div>
        <div class="push-left-for-usericon">
        {if $item->author}
            {$item->description|clean_html|safe}
        {else}
            {$item->description|safe}
        {/if}
        </div>
        {if  $item->private}
            <div class="comment-privacy metadata">
              <em class="privatemessage"> {$item->pubstatus} </em>
            </div>
        {/if}
    </div>
{/foreach}
</div>
