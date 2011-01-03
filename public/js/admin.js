function destroy(tablename, record_id)
{
        $.post("/index.php/admin/ajax/destroy", { id: record_id, table_name: tablename },
               function(data)
               {
                        alert(data);
                        if(document.getElementById(tablename+record_id) != null){
                                $('#'+tablename+record_id).html('');
                        }
                        else{
                                $('#'+record_id).html('');
                        }
                        $('.messages').html('<ul><li>запись успешно удалена</li></ul>');
               }
        );
}

function destroyNews(id)             { destroy('news', id);               return false; }
function destroySection(id)          { destroy('section', id);            return false; }
function destroySectionPage(id)      { destroy('section_page', id);       return false; }
function destroyBanner(id)           { destroy('banner', id);             return false; }
function destroyModel(id)            { destroy('model', id);              return false; }
function destroyModelPhoto(id)       { destroy('model_photo', id);        return false; }
function destroyProject(id)          { destroy('project', id);            return false; }
function destroyProjectPage(id)      { destroy('project_page', id);       return false; }
function destroyProjectPagePhoto(id) { destroy('project_page_photo', id); return false; }
function destroyContest(id)          { destroy('contest', id);            return false; }
function destroyBidder(id)           { destroy('bidder', id);             return false; }
function destroyProfile(id)          { destroy('profile', id);            return false; }
function destroyPicture(id)          { destroy('picture', id);            return false; }
