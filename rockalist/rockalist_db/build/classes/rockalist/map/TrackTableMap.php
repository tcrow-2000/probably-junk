<?php



/**
 * This class defines the structure of the 'track' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.rockalist.map
 */
class TrackTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'rockalist.map.TrackTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('track');
        $this->setPhpName('Track');
        $this->setClassname('Track');
        $this->setPackage('rockalist');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('url', 'Url', 'VARCHAR', true, 255, null);
        $this->addColumn('title', 'Title', 'VARCHAR', true, 255, null);
        $this->addColumn('genre', 'Genre', 'VARCHAR', false, 255, null);
        $this->addColumn('year', 'Year', 'INTEGER', false, null, null);
        $this->addColumn('date_added', 'DateAdded', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
        $this->addForeignKey('artist_id', 'ArtistId', 'INTEGER', 'artist', 'id', true, null, null);
        $this->addForeignKey('album_id', 'AlbumId', 'INTEGER', 'album', 'id', false, null, null);
        $this->addForeignKey('user_id', 'UserId', 'INTEGER', 'user', 'id', true, null, null);
        $this->addColumn('rating_total', 'RatingTotal', 'INTEGER', false, null, null);
        $this->addColumn('rating_count', 'RatingCount', 'INTEGER', false, null, null);
        $this->addColumn('rating_average', 'RatingAverage', 'INTEGER', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Artist', 'Artist', RelationMap::MANY_TO_ONE, array('artist_id' => 'id', ), null, null);
        $this->addRelation('Album', 'Album', RelationMap::MANY_TO_ONE, array('album_id' => 'id', ), null, null);
        $this->addRelation('User', 'User', RelationMap::MANY_TO_ONE, array('user_id' => 'id', ), null, null);
        $this->addRelation('PlayListTrack', 'PlayListTrack', RelationMap::ONE_TO_MANY, array('id' => 'track_id', ), null, null, 'PlayListTracks');
        $this->addRelation('PlayList', 'PlayList', RelationMap::MANY_TO_MANY, array(), null, null, 'PlayLists');
    } // buildRelations()

} // TrackTableMap
