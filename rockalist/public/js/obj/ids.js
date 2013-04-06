var IDs = function() {
    
};
IDs.playListId = 0;
IDs.prototype.getPlayListId = function() {
    return IDs.playListId++;
};