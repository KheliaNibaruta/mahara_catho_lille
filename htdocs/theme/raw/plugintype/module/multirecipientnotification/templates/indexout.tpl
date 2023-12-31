{include file="header.tpl"}
<a title="{str section='module.multirecipientnotification' tag='composemessagedesc'}" class="btn-with-heading btn-lg btn btn-secondary" href="{$WWWROOT}module/multirecipientnotification/sendmessage.php">
    <span class="icon icon-edit icon-regular left" role="presentation" aria-hidden="true"></span>
    {str section='module.multirecipientnotification' tag='composemessage'}
</a>
<div id="notifications-page-header"/></div>
{include file="module:multirecipientnotification:indexsearch.tpl" searchdata=$searchdata boxtype=outbox}
{if $activitylist.count > 0}

    <div id="notifications" class="notification-parent view-container"  data-requesturl="indexout.json.php">

        <div class="btn-group bulk-actions" role="group">
            <label class="btn btn-secondary" for="selectall">
                <input type="checkbox" name="selectall" id="selectall" data-bs-togglecheckbox="tocheck">
                <span class="visually-hidden">{str section='activity' tag='selectall'}</span>
            </label>

            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                {str section='admin' tag='bulkactions'}  <span class="icon icon-caret-down right"></span>
            </button>

            <div class="activity-buttons dropdown-menu" role="menu">
                <button class="btn btn-link btn-link-danger text-start" data-action="deleteselected">
                    {str tag='delete'}
                </button>

                <a href="#delete_all_notifications_submit" class="btn btn-link btn-link-danger text-start" data-bs-triggersubmit="delete_all_notifications_submit">
                    {str section='activity' tag='deleteallnotifications'}
                </a>
            </div>
        </div>
        <form method="post" class="form-inline form-select-filter pieform">
            <div class="form-group">
                <label for="notifications_type" class="visually-hidden">{str section='activity' tag='type'}:</label>
                <div class="input-group select-group">
                    <div class="input-group-prepend" id="icon-addon-filter">
                        <span class="icon icon-filter" role="presentation" aria-hidden="true"></span>
                    </div>
                    <div class="select form-group">
                        <div class="picker">
                            <select class="form-control select js-notifications-type" id="notifications_type" name="type">
                            {foreach from=$options item=name key=t}
                                <option value="{$t}"{if $type == $t} selected{/if}>
                                    {$name}
                                </option>
                            {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form class="form-notificationlist js-notifications" name="notificationlist" method="post">
            <div id="activitylist" class="notification-list">
                {$activitylist['html']|safe}
            </div>
        </form>

        {$deleteall|safe}
        <div class="fullwidth">
            {$activitylist['pagination']|safe}
        </div>
    </div>
{else}
<div class="notifications-empty" id="notifications">
    <p class="no-results">
        {if $searchdata->searchtext}
            {str section='activity' tag='noresultsfound'}
        {else}
            {str section='activity' tag='youroutboxisempty'}
        {/if}
    </p>
</div>
{/if}


{include file="footer.tpl"}
