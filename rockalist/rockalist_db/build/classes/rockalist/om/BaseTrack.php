<?php


/**
 * Base class that represents a row from the 'track' table.
 *
 *
 *
 * @package    propel.generator.rockalist.om
 */
abstract class BaseTrack extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'TrackPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        TrackPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the url field.
     * @var        string
     */
    protected $url;

    /**
     * The value for the title field.
     * @var        string
     */
    protected $title;

    /**
     * The value for the genre field.
     * @var        string
     */
    protected $genre;

    /**
     * The value for the year field.
     * @var        int
     */
    protected $year;

    /**
     * The value for the date_added field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        string
     */
    protected $date_added;

    /**
     * The value for the artist_id field.
     * @var        int
     */
    protected $artist_id;

    /**
     * The value for the album_id field.
     * @var        int
     */
    protected $album_id;

    /**
     * @var        Artist
     */
    protected $aArtist;

    /**
     * @var        Album
     */
    protected $aAlbum;

    /**
     * @var        PropelObjectCollection|PlayListTrack[] Collection to store aggregation of PlayListTrack objects.
     */
    protected $collPlayListTracks;
    protected $collPlayListTracksPartial;

    /**
     * @var        PropelObjectCollection|PlayList[] Collection to store aggregation of PlayList objects.
     */
    protected $collPlayLists;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $playListsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $playListTracksScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
    }

    /**
     * Initializes internal state of BaseTrack object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {

        return $this->id;
    }

    /**
     * Get the [url] column value.
     *
     * @return string
     */
    public function getUrl()
    {

        return $this->url;
    }

    /**
     * Get the [title] column value.
     *
     * @return string
     */
    public function getTitle()
    {

        return $this->title;
    }

    /**
     * Get the [genre] column value.
     *
     * @return string
     */
    public function getGenre()
    {

        return $this->genre;
    }

    /**
     * Get the [year] column value.
     *
     * @return int
     */
    public function getYear()
    {

        return $this->year;
    }

    /**
     * Get the [optionally formatted] temporal [date_added] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getDateAdded($format = 'Y-m-d H:i:s')
    {
        if ($this->date_added === null) {
            return null;
        }

        if ($this->date_added === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->date_added);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->date_added, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [artist_id] column value.
     *
     * @return int
     */
    public function getArtistId()
    {

        return $this->artist_id;
    }

    /**
     * Get the [album_id] column value.
     *
     * @return int
     */
    public function getAlbumId()
    {

        return $this->album_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Track The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = TrackPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [url] column.
     *
     * @param string $v new value
     * @return Track The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[] = TrackPeer::URL;
        }


        return $this;
    } // setUrl()

    /**
     * Set the value of [title] column.
     *
     * @param string $v new value
     * @return Track The current object (for fluent API support)
     */
    public function setTitle($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->title !== $v) {
            $this->title = $v;
            $this->modifiedColumns[] = TrackPeer::TITLE;
        }


        return $this;
    } // setTitle()

    /**
     * Set the value of [genre] column.
     *
     * @param string $v new value
     * @return Track The current object (for fluent API support)
     */
    public function setGenre($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->genre !== $v) {
            $this->genre = $v;
            $this->modifiedColumns[] = TrackPeer::GENRE;
        }


        return $this;
    } // setGenre()

    /**
     * Set the value of [year] column.
     *
     * @param int $v new value
     * @return Track The current object (for fluent API support)
     */
    public function setYear($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->year !== $v) {
            $this->year = $v;
            $this->modifiedColumns[] = TrackPeer::YEAR;
        }


        return $this;
    } // setYear()

    /**
     * Sets the value of [date_added] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Track The current object (for fluent API support)
     */
    public function setDateAdded($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_added !== null || $dt !== null) {
            $currentDateAsString = ($this->date_added !== null && $tmpDt = new DateTime($this->date_added)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_added = $newDateAsString;
                $this->modifiedColumns[] = TrackPeer::DATE_ADDED;
            }
        } // if either are not null


        return $this;
    } // setDateAdded()

    /**
     * Set the value of [artist_id] column.
     *
     * @param int $v new value
     * @return Track The current object (for fluent API support)
     */
    public function setArtistId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->artist_id !== $v) {
            $this->artist_id = $v;
            $this->modifiedColumns[] = TrackPeer::ARTIST_ID;
        }

        if ($this->aArtist !== null && $this->aArtist->getId() !== $v) {
            $this->aArtist = null;
        }


        return $this;
    } // setArtistId()

    /**
     * Set the value of [album_id] column.
     *
     * @param int $v new value
     * @return Track The current object (for fluent API support)
     */
    public function setAlbumId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->album_id !== $v) {
            $this->album_id = $v;
            $this->modifiedColumns[] = TrackPeer::ALBUM_ID;
        }

        if ($this->aAlbum !== null && $this->aAlbum->getId() !== $v) {
            $this->aAlbum = null;
        }


        return $this;
    } // setAlbumId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->url = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->title = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->genre = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->year = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->date_added = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->artist_id = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->album_id = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 8; // 8 = TrackPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Track object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aArtist !== null && $this->artist_id !== $this->aArtist->getId()) {
            $this->aArtist = null;
        }
        if ($this->aAlbum !== null && $this->album_id !== $this->aAlbum->getId()) {
            $this->aAlbum = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TrackPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = TrackPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aArtist = null;
            $this->aAlbum = null;
            $this->collPlayListTracks = null;

            $this->collPlayLists = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TrackPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = TrackQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(TrackPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                TrackPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aArtist !== null) {
                if ($this->aArtist->isModified() || $this->aArtist->isNew()) {
                    $affectedRows += $this->aArtist->save($con);
                }
                $this->setArtist($this->aArtist);
            }

            if ($this->aAlbum !== null) {
                if ($this->aAlbum->isModified() || $this->aAlbum->isNew()) {
                    $affectedRows += $this->aAlbum->save($con);
                }
                $this->setAlbum($this->aAlbum);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->playListsScheduledForDeletion !== null) {
                if (!$this->playListsScheduledForDeletion->isEmpty()) {
                    $pks = array();
                    $pk = $this->getPrimaryKey();
                    foreach ($this->playListsScheduledForDeletion->getPrimaryKeys(false) as $remotePk) {
                        $pks[] = array($remotePk, $pk);
                    }
                    PlayListTrackQuery::create()
                        ->filterByPrimaryKeys($pks)
                        ->delete($con);
                    $this->playListsScheduledForDeletion = null;
                }

                foreach ($this->getPlayLists() as $playList) {
                    if ($playList->isModified()) {
                        $playList->save($con);
                    }
                }
            } elseif ($this->collPlayLists) {
                foreach ($this->collPlayLists as $playList) {
                    if ($playList->isModified()) {
                        $playList->save($con);
                    }
                }
            }

            if ($this->playListTracksScheduledForDeletion !== null) {
                if (!$this->playListTracksScheduledForDeletion->isEmpty()) {
                    foreach ($this->playListTracksScheduledForDeletion as $playListTrack) {
                        // need to save related object because we set the relation to null
                        $playListTrack->save($con);
                    }
                    $this->playListTracksScheduledForDeletion = null;
                }
            }

            if ($this->collPlayListTracks !== null) {
                foreach ($this->collPlayListTracks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = TrackPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . TrackPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(TrackPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(TrackPeer::URL)) {
            $modifiedColumns[':p' . $index++]  = '`url`';
        }
        if ($this->isColumnModified(TrackPeer::TITLE)) {
            $modifiedColumns[':p' . $index++]  = '`title`';
        }
        if ($this->isColumnModified(TrackPeer::GENRE)) {
            $modifiedColumns[':p' . $index++]  = '`genre`';
        }
        if ($this->isColumnModified(TrackPeer::YEAR)) {
            $modifiedColumns[':p' . $index++]  = '`year`';
        }
        if ($this->isColumnModified(TrackPeer::DATE_ADDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_added`';
        }
        if ($this->isColumnModified(TrackPeer::ARTIST_ID)) {
            $modifiedColumns[':p' . $index++]  = '`artist_id`';
        }
        if ($this->isColumnModified(TrackPeer::ALBUM_ID)) {
            $modifiedColumns[':p' . $index++]  = '`album_id`';
        }

        $sql = sprintf(
            'INSERT INTO `track` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`url`':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case '`title`':
                        $stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
                        break;
                    case '`genre`':
                        $stmt->bindValue($identifier, $this->genre, PDO::PARAM_STR);
                        break;
                    case '`year`':
                        $stmt->bindValue($identifier, $this->year, PDO::PARAM_INT);
                        break;
                    case '`date_added`':
                        $stmt->bindValue($identifier, $this->date_added, PDO::PARAM_STR);
                        break;
                    case '`artist_id`':
                        $stmt->bindValue($identifier, $this->artist_id, PDO::PARAM_INT);
                        break;
                    case '`album_id`':
                        $stmt->bindValue($identifier, $this->album_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aArtist !== null) {
                if (!$this->aArtist->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aArtist->getValidationFailures());
                }
            }

            if ($this->aAlbum !== null) {
                if (!$this->aAlbum->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aAlbum->getValidationFailures());
                }
            }


            if (($retval = TrackPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPlayListTracks !== null) {
                    foreach ($this->collPlayListTracks as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TrackPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getUrl();
                break;
            case 2:
                return $this->getTitle();
                break;
            case 3:
                return $this->getGenre();
                break;
            case 4:
                return $this->getYear();
                break;
            case 5:
                return $this->getDateAdded();
                break;
            case 6:
                return $this->getArtistId();
                break;
            case 7:
                return $this->getAlbumId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Track'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Track'][$this->getPrimaryKey()] = true;
        $keys = TrackPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUrl(),
            $keys[2] => $this->getTitle(),
            $keys[3] => $this->getGenre(),
            $keys[4] => $this->getYear(),
            $keys[5] => $this->getDateAdded(),
            $keys[6] => $this->getArtistId(),
            $keys[7] => $this->getAlbumId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aArtist) {
                $result['Artist'] = $this->aArtist->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aAlbum) {
                $result['Album'] = $this->aAlbum->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPlayListTracks) {
                $result['PlayListTracks'] = $this->collPlayListTracks->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = TrackPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUrl($value);
                break;
            case 2:
                $this->setTitle($value);
                break;
            case 3:
                $this->setGenre($value);
                break;
            case 4:
                $this->setYear($value);
                break;
            case 5:
                $this->setDateAdded($value);
                break;
            case 6:
                $this->setArtistId($value);
                break;
            case 7:
                $this->setAlbumId($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = TrackPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUrl($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setTitle($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setGenre($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setYear($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setDateAdded($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setArtistId($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setAlbumId($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(TrackPeer::DATABASE_NAME);

        if ($this->isColumnModified(TrackPeer::ID)) $criteria->add(TrackPeer::ID, $this->id);
        if ($this->isColumnModified(TrackPeer::URL)) $criteria->add(TrackPeer::URL, $this->url);
        if ($this->isColumnModified(TrackPeer::TITLE)) $criteria->add(TrackPeer::TITLE, $this->title);
        if ($this->isColumnModified(TrackPeer::GENRE)) $criteria->add(TrackPeer::GENRE, $this->genre);
        if ($this->isColumnModified(TrackPeer::YEAR)) $criteria->add(TrackPeer::YEAR, $this->year);
        if ($this->isColumnModified(TrackPeer::DATE_ADDED)) $criteria->add(TrackPeer::DATE_ADDED, $this->date_added);
        if ($this->isColumnModified(TrackPeer::ARTIST_ID)) $criteria->add(TrackPeer::ARTIST_ID, $this->artist_id);
        if ($this->isColumnModified(TrackPeer::ALBUM_ID)) $criteria->add(TrackPeer::ALBUM_ID, $this->album_id);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(TrackPeer::DATABASE_NAME);
        $criteria->add(TrackPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Track (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUrl($this->getUrl());
        $copyObj->setTitle($this->getTitle());
        $copyObj->setGenre($this->getGenre());
        $copyObj->setYear($this->getYear());
        $copyObj->setDateAdded($this->getDateAdded());
        $copyObj->setArtistId($this->getArtistId());
        $copyObj->setAlbumId($this->getAlbumId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPlayListTracks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPlayListTrack($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Track Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return TrackPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new TrackPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Artist object.
     *
     * @param   Artist $v
     * @return Track The current object (for fluent API support)
     * @throws PropelException
     */
    public function setArtist(Artist $v = null)
    {
        if ($v === null) {
            $this->setArtistId(NULL);
        } else {
            $this->setArtistId($v->getId());
        }

        $this->aArtist = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Artist object, it will not be re-added.
        if ($v !== null) {
            $v->addTrack($this);
        }


        return $this;
    }


    /**
     * Get the associated Artist object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Artist The associated Artist object.
     * @throws PropelException
     */
    public function getArtist(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aArtist === null && ($this->artist_id !== null) && $doQuery) {
            $this->aArtist = ArtistQuery::create()->findPk($this->artist_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aArtist->addTracks($this);
             */
        }

        return $this->aArtist;
    }

    /**
     * Declares an association between this object and a Album object.
     *
     * @param   Album $v
     * @return Track The current object (for fluent API support)
     * @throws PropelException
     */
    public function setAlbum(Album $v = null)
    {
        if ($v === null) {
            $this->setAlbumId(NULL);
        } else {
            $this->setAlbumId($v->getId());
        }

        $this->aAlbum = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Album object, it will not be re-added.
        if ($v !== null) {
            $v->addTrack($this);
        }


        return $this;
    }


    /**
     * Get the associated Album object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Album The associated Album object.
     * @throws PropelException
     */
    public function getAlbum(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aAlbum === null && ($this->album_id !== null) && $doQuery) {
            $this->aAlbum = AlbumQuery::create()->findPk($this->album_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aAlbum->addTracks($this);
             */
        }

        return $this->aAlbum;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PlayListTrack' == $relationName) {
            $this->initPlayListTracks();
        }
    }

    /**
     * Clears out the collPlayListTracks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Track The current object (for fluent API support)
     * @see        addPlayListTracks()
     */
    public function clearPlayListTracks()
    {
        $this->collPlayListTracks = null; // important to set this to null since that means it is uninitialized
        $this->collPlayListTracksPartial = null;

        return $this;
    }

    /**
     * reset is the collPlayListTracks collection loaded partially
     *
     * @return void
     */
    public function resetPartialPlayListTracks($v = true)
    {
        $this->collPlayListTracksPartial = $v;
    }

    /**
     * Initializes the collPlayListTracks collection.
     *
     * By default this just sets the collPlayListTracks collection to an empty array (like clearcollPlayListTracks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPlayListTracks($overrideExisting = true)
    {
        if (null !== $this->collPlayListTracks && !$overrideExisting) {
            return;
        }
        $this->collPlayListTracks = new PropelObjectCollection();
        $this->collPlayListTracks->setModel('PlayListTrack');
    }

    /**
     * Gets an array of PlayListTrack objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Track is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PlayListTrack[] List of PlayListTrack objects
     * @throws PropelException
     */
    public function getPlayListTracks($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPlayListTracksPartial && !$this->isNew();
        if (null === $this->collPlayListTracks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPlayListTracks) {
                // return empty collection
                $this->initPlayListTracks();
            } else {
                $collPlayListTracks = PlayListTrackQuery::create(null, $criteria)
                    ->filterByTrack($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPlayListTracksPartial && count($collPlayListTracks)) {
                      $this->initPlayListTracks(false);

                      foreach ($collPlayListTracks as $obj) {
                        if (false == $this->collPlayListTracks->contains($obj)) {
                          $this->collPlayListTracks->append($obj);
                        }
                      }

                      $this->collPlayListTracksPartial = true;
                    }

                    $collPlayListTracks->getInternalIterator()->rewind();

                    return $collPlayListTracks;
                }

                if ($partial && $this->collPlayListTracks) {
                    foreach ($this->collPlayListTracks as $obj) {
                        if ($obj->isNew()) {
                            $collPlayListTracks[] = $obj;
                        }
                    }
                }

                $this->collPlayListTracks = $collPlayListTracks;
                $this->collPlayListTracksPartial = false;
            }
        }

        return $this->collPlayListTracks;
    }

    /**
     * Sets a collection of PlayListTrack objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $playListTracks A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Track The current object (for fluent API support)
     */
    public function setPlayListTracks(PropelCollection $playListTracks, PropelPDO $con = null)
    {
        $playListTracksToDelete = $this->getPlayListTracks(new Criteria(), $con)->diff($playListTracks);


        $this->playListTracksScheduledForDeletion = $playListTracksToDelete;

        foreach ($playListTracksToDelete as $playListTrackRemoved) {
            $playListTrackRemoved->setTrack(null);
        }

        $this->collPlayListTracks = null;
        foreach ($playListTracks as $playListTrack) {
            $this->addPlayListTrack($playListTrack);
        }

        $this->collPlayListTracks = $playListTracks;
        $this->collPlayListTracksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PlayListTrack objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PlayListTrack objects.
     * @throws PropelException
     */
    public function countPlayListTracks(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPlayListTracksPartial && !$this->isNew();
        if (null === $this->collPlayListTracks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPlayListTracks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPlayListTracks());
            }
            $query = PlayListTrackQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByTrack($this)
                ->count($con);
        }

        return count($this->collPlayListTracks);
    }

    /**
     * Method called to associate a PlayListTrack object to this object
     * through the PlayListTrack foreign key attribute.
     *
     * @param   PlayListTrack $l PlayListTrack
     * @return Track The current object (for fluent API support)
     */
    public function addPlayListTrack(PlayListTrack $l)
    {
        if ($this->collPlayListTracks === null) {
            $this->initPlayListTracks();
            $this->collPlayListTracksPartial = true;
        }
        if (!in_array($l, $this->collPlayListTracks->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPlayListTrack($l);
        }

        return $this;
    }

    /**
     * @param	PlayListTrack $playListTrack The playListTrack object to add.
     */
    protected function doAddPlayListTrack($playListTrack)
    {
        $this->collPlayListTracks[]= $playListTrack;
        $playListTrack->setTrack($this);
    }

    /**
     * @param	PlayListTrack $playListTrack The playListTrack object to remove.
     * @return Track The current object (for fluent API support)
     */
    public function removePlayListTrack($playListTrack)
    {
        if ($this->getPlayListTracks()->contains($playListTrack)) {
            $this->collPlayListTracks->remove($this->collPlayListTracks->search($playListTrack));
            if (null === $this->playListTracksScheduledForDeletion) {
                $this->playListTracksScheduledForDeletion = clone $this->collPlayListTracks;
                $this->playListTracksScheduledForDeletion->clear();
            }
            $this->playListTracksScheduledForDeletion[]= clone $playListTrack;
            $playListTrack->setTrack(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Track is new, it will return
     * an empty collection; or if this Track has previously
     * been saved, it will retrieve related PlayListTracks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Track.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PlayListTrack[] List of PlayListTrack objects
     */
    public function getPlayListTracksJoinPlayList($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PlayListTrackQuery::create(null, $criteria);
        $query->joinWith('PlayList', $join_behavior);

        return $this->getPlayListTracks($query, $con);
    }

    /**
     * Clears out the collPlayLists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Track The current object (for fluent API support)
     * @see        addPlayLists()
     */
    public function clearPlayLists()
    {
        $this->collPlayLists = null; // important to set this to null since that means it is uninitialized
        $this->collPlayListsPartial = null;

        return $this;
    }

    /**
     * Initializes the collPlayLists collection.
     *
     * By default this just sets the collPlayLists collection to an empty collection (like clearPlayLists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @return void
     */
    public function initPlayLists()
    {
        $this->collPlayLists = new PropelObjectCollection();
        $this->collPlayLists->setModel('PlayList');
    }

    /**
     * Gets a collection of PlayList objects related by a many-to-many relationship
     * to the current object by way of the playlisttrack cross-reference table.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Track is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param PropelPDO $con Optional connection object
     *
     * @return PropelObjectCollection|PlayList[] List of PlayList objects
     */
    public function getPlayLists($criteria = null, PropelPDO $con = null)
    {
        if (null === $this->collPlayLists || null !== $criteria) {
            if ($this->isNew() && null === $this->collPlayLists) {
                // return empty collection
                $this->initPlayLists();
            } else {
                $collPlayLists = PlayListQuery::create(null, $criteria)
                    ->filterByTrack($this)
                    ->find($con);
                if (null !== $criteria) {
                    return $collPlayLists;
                }
                $this->collPlayLists = $collPlayLists;
            }
        }

        return $this->collPlayLists;
    }

    /**
     * Sets a collection of PlayList objects related by a many-to-many relationship
     * to the current object by way of the playlisttrack cross-reference table.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $playLists A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Track The current object (for fluent API support)
     */
    public function setPlayLists(PropelCollection $playLists, PropelPDO $con = null)
    {
        $this->clearPlayLists();
        $currentPlayLists = $this->getPlayLists();

        $this->playListsScheduledForDeletion = $currentPlayLists->diff($playLists);

        foreach ($playLists as $playList) {
            if (!$currentPlayLists->contains($playList)) {
                $this->doAddPlayList($playList);
            }
        }

        $this->collPlayLists = $playLists;

        return $this;
    }

    /**
     * Gets the number of PlayList objects related by a many-to-many relationship
     * to the current object by way of the playlisttrack cross-reference table.
     *
     * @param Criteria $criteria Optional query object to filter the query
     * @param boolean $distinct Set to true to force count distinct
     * @param PropelPDO $con Optional connection object
     *
     * @return int the number of related PlayList objects
     */
    public function countPlayLists($criteria = null, $distinct = false, PropelPDO $con = null)
    {
        if (null === $this->collPlayLists || null !== $criteria) {
            if ($this->isNew() && null === $this->collPlayLists) {
                return 0;
            } else {
                $query = PlayListQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByTrack($this)
                    ->count($con);
            }
        } else {
            return count($this->collPlayLists);
        }
    }

    /**
     * Associate a PlayList object to this object
     * through the playlisttrack cross reference table.
     *
     * @param PlayList $playList The PlayListTrack object to relate
     * @return Track The current object (for fluent API support)
     */
    public function addPlayList(PlayList $playList)
    {
        if ($this->collPlayLists === null) {
            $this->initPlayLists();
        }
        if (!$this->collPlayLists->contains($playList)) { // only add it if the **same** object is not already associated
            $this->doAddPlayList($playList);

            $this->collPlayLists[]= $playList;
        }

        return $this;
    }

    /**
     * @param	PlayList $playList The playList object to add.
     */
    protected function doAddPlayList($playList)
    {
        $playListTrack = new PlayListTrack();
        $playListTrack->setPlayList($playList);
        $this->addPlayListTrack($playListTrack);
    }

    /**
     * Remove a PlayList object to this object
     * through the playlisttrack cross reference table.
     *
     * @param PlayList $playList The PlayListTrack object to relate
     * @return Track The current object (for fluent API support)
     */
    public function removePlayList(PlayList $playList)
    {
        if ($this->getPlayLists()->contains($playList)) {
            $this->collPlayLists->remove($this->collPlayLists->search($playList));
            if (null === $this->playListsScheduledForDeletion) {
                $this->playListsScheduledForDeletion = clone $this->collPlayLists;
                $this->playListsScheduledForDeletion->clear();
            }
            $this->playListsScheduledForDeletion[]= $playList;
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->url = null;
        $this->title = null;
        $this->genre = null;
        $this->year = null;
        $this->date_added = null;
        $this->artist_id = null;
        $this->album_id = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collPlayListTracks) {
                foreach ($this->collPlayListTracks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPlayLists) {
                foreach ($this->collPlayLists as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aArtist instanceof Persistent) {
              $this->aArtist->clearAllReferences($deep);
            }
            if ($this->aAlbum instanceof Persistent) {
              $this->aAlbum->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collPlayListTracks instanceof PropelCollection) {
            $this->collPlayListTracks->clearIterator();
        }
        $this->collPlayListTracks = null;
        if ($this->collPlayLists instanceof PropelCollection) {
            $this->collPlayLists->clearIterator();
        }
        $this->collPlayLists = null;
        $this->aArtist = null;
        $this->aAlbum = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(TrackPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
