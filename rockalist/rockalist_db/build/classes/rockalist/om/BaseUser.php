<?php


/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
 * @package    propel.generator.rockalist.om
 */
abstract class BaseUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
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
     * The value for the email field.
     * @var        string
     */
    protected $email;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the password field.
     * @var        string
     */
    protected $password;

    /**
     * The value for the subscribed field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $subscribed;

    /**
     * The value for the registered field.
     * Note: this column has a database default value of: false
     * @var        boolean
     */
    protected $registered;

    /**
     * The value for the uniqueid field.
     * @var        string
     */
    protected $uniqueid;

    /**
     * The value for the date_added field.
     * Note: this column has a database default value of: (expression) CURRENT_TIMESTAMP
     * @var        string
     */
    protected $date_added;

    /**
     * The value for the last_login field.
     * @var        string
     */
    protected $last_login;

    /**
     * @var        PropelObjectCollection|Track[] Collection to store aggregation of Track objects.
     */
    protected $collTracks;
    protected $collTracksPartial;

    /**
     * @var        PropelObjectCollection|PlayList[] Collection to store aggregation of PlayList objects.
     */
    protected $collPlaylists;
    protected $collPlaylistsPartial;

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
    protected $tracksScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $playlistsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->subscribed = false;
        $this->registered = false;
    }

    /**
     * Initializes internal state of BaseUser object.
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
     * Get the [email] column value.
     *
     * @return string
     */
    public function getEmail()
    {

        return $this->email;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {

        return $this->name;
    }

    /**
     * Get the [password] column value.
     *
     * @return string
     */
    public function getPassword()
    {

        return $this->password;
    }

    /**
     * Get the [subscribed] column value.
     *
     * @return boolean
     */
    public function getSubscribed()
    {

        return $this->subscribed;
    }

    /**
     * Get the [registered] column value.
     *
     * @return boolean
     */
    public function getRegistered()
    {

        return $this->registered;
    }

    /**
     * Get the [uniqueid] column value.
     *
     * @return string
     */
    public function getUniqueid()
    {

        return $this->uniqueid;
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
     * Get the [optionally formatted] temporal [last_login] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLastLogin($format = 'Y-m-d H:i:s')
    {
        if ($this->last_login === null) {
            return null;
        }

        if ($this->last_login === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->last_login);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->last_login, true), $x);
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
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = UserPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [email] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setEmail($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->email !== $v) {
            $this->email = $v;
            $this->modifiedColumns[] = UserPeer::EMAIL;
        }


        return $this;
    } // setEmail()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[] = UserPeer::NAME;
        }


        return $this;
    } // setName()

    /**
     * Set the value of [password] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setPassword($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->password !== $v) {
            $this->password = $v;
            $this->modifiedColumns[] = UserPeer::PASSWORD;
        }


        return $this;
    } // setPassword()

    /**
     * Sets the value of the [subscribed] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return User The current object (for fluent API support)
     */
    public function setSubscribed($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->subscribed !== $v) {
            $this->subscribed = $v;
            $this->modifiedColumns[] = UserPeer::SUBSCRIBED;
        }


        return $this;
    } // setSubscribed()

    /**
     * Sets the value of the [registered] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return User The current object (for fluent API support)
     */
    public function setRegistered($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->registered !== $v) {
            $this->registered = $v;
            $this->modifiedColumns[] = UserPeer::REGISTERED;
        }


        return $this;
    } // setRegistered()

    /**
     * Set the value of [uniqueid] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUniqueid($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->uniqueid !== $v) {
            $this->uniqueid = $v;
            $this->modifiedColumns[] = UserPeer::UNIQUEID;
        }


        return $this;
    } // setUniqueid()

    /**
     * Sets the value of [date_added] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setDateAdded($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->date_added !== null || $dt !== null) {
            $currentDateAsString = ($this->date_added !== null && $tmpDt = new DateTime($this->date_added)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->date_added = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::DATE_ADDED;
            }
        } // if either are not null


        return $this;
    } // setDateAdded()

    /**
     * Sets the value of [last_login] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setLastLogin($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->last_login !== null || $dt !== null) {
            $currentDateAsString = ($this->last_login !== null && $tmpDt = new DateTime($this->last_login)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->last_login = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::LAST_LOGIN;
            }
        } // if either are not null


        return $this;
    } // setLastLogin()

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
            if ($this->subscribed !== false) {
                return false;
            }

            if ($this->registered !== false) {
                return false;
            }

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
            $this->email = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->password = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->subscribed = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
            $this->registered = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
            $this->uniqueid = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->date_added = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->last_login = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 9; // 9 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collTracks = null;

            $this->collPlaylists = null;

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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
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
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                UserPeer::addInstanceToPool($this);
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

            if ($this->tracksScheduledForDeletion !== null) {
                if (!$this->tracksScheduledForDeletion->isEmpty()) {
                    foreach ($this->tracksScheduledForDeletion as $track) {
                        // need to save related object because we set the relation to null
                        $track->save($con);
                    }
                    $this->tracksScheduledForDeletion = null;
                }
            }

            if ($this->collTracks !== null) {
                foreach ($this->collTracks as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->playlistsScheduledForDeletion !== null) {
                if (!$this->playlistsScheduledForDeletion->isEmpty()) {
                    foreach ($this->playlistsScheduledForDeletion as $playlist) {
                        // need to save related object because we set the relation to null
                        $playlist->save($con);
                    }
                    $this->playlistsScheduledForDeletion = null;
                }
            }

            if ($this->collPlaylists !== null) {
                foreach ($this->collPlaylists as $referrerFK) {
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

        $this->modifiedColumns[] = UserPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(UserPeer::EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`email`';
        }
        if ($this->isColumnModified(UserPeer::NAME)) {
            $modifiedColumns[':p' . $index++]  = '`name`';
        }
        if ($this->isColumnModified(UserPeer::PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = '`password`';
        }
        if ($this->isColumnModified(UserPeer::SUBSCRIBED)) {
            $modifiedColumns[':p' . $index++]  = '`subscribed`';
        }
        if ($this->isColumnModified(UserPeer::REGISTERED)) {
            $modifiedColumns[':p' . $index++]  = '`registered`';
        }
        if ($this->isColumnModified(UserPeer::UNIQUEID)) {
            $modifiedColumns[':p' . $index++]  = '`uniqueid`';
        }
        if ($this->isColumnModified(UserPeer::DATE_ADDED)) {
            $modifiedColumns[':p' . $index++]  = '`date_added`';
        }
        if ($this->isColumnModified(UserPeer::LAST_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = '`last_login`';
        }

        $sql = sprintf(
            'INSERT INTO `user` (%s) VALUES (%s)',
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
                    case '`email`':
                        $stmt->bindValue($identifier, $this->email, PDO::PARAM_STR);
                        break;
                    case '`name`':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case '`password`':
                        $stmt->bindValue($identifier, $this->password, PDO::PARAM_STR);
                        break;
                    case '`subscribed`':
                        $stmt->bindValue($identifier, (int) $this->subscribed, PDO::PARAM_INT);
                        break;
                    case '`registered`':
                        $stmt->bindValue($identifier, (int) $this->registered, PDO::PARAM_INT);
                        break;
                    case '`uniqueid`':
                        $stmt->bindValue($identifier, $this->uniqueid, PDO::PARAM_STR);
                        break;
                    case '`date_added`':
                        $stmt->bindValue($identifier, $this->date_added, PDO::PARAM_STR);
                        break;
                    case '`last_login`':
                        $stmt->bindValue($identifier, $this->last_login, PDO::PARAM_STR);
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


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collTracks !== null) {
                    foreach ($this->collTracks as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collPlaylists !== null) {
                    foreach ($this->collPlaylists as $referrerFK) {
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getEmail();
                break;
            case 2:
                return $this->getName();
                break;
            case 3:
                return $this->getPassword();
                break;
            case 4:
                return $this->getSubscribed();
                break;
            case 5:
                return $this->getRegistered();
                break;
            case 6:
                return $this->getUniqueid();
                break;
            case 7:
                return $this->getDateAdded();
                break;
            case 8:
                return $this->getLastLogin();
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
        if (isset($alreadyDumpedObjects['User'][serialize($this->getPrimaryKey())])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][serialize($this->getPrimaryKey())] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getEmail(),
            $keys[2] => $this->getName(),
            $keys[3] => $this->getPassword(),
            $keys[4] => $this->getSubscribed(),
            $keys[5] => $this->getRegistered(),
            $keys[6] => $this->getUniqueid(),
            $keys[7] => $this->getDateAdded(),
            $keys[8] => $this->getLastLogin(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collTracks) {
                $result['Tracks'] = $this->collTracks->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collPlaylists) {
                $result['Playlists'] = $this->collPlaylists->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setEmail($value);
                break;
            case 2:
                $this->setName($value);
                break;
            case 3:
                $this->setPassword($value);
                break;
            case 4:
                $this->setSubscribed($value);
                break;
            case 5:
                $this->setRegistered($value);
                break;
            case 6:
                $this->setUniqueid($value);
                break;
            case 7:
                $this->setDateAdded($value);
                break;
            case 8:
                $this->setLastLogin($value);
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
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setEmail($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPassword($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setSubscribed($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setRegistered($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUniqueid($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setDateAdded($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setLastLogin($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
        if ($this->isColumnModified(UserPeer::EMAIL)) $criteria->add(UserPeer::EMAIL, $this->email);
        if ($this->isColumnModified(UserPeer::NAME)) $criteria->add(UserPeer::NAME, $this->name);
        if ($this->isColumnModified(UserPeer::PASSWORD)) $criteria->add(UserPeer::PASSWORD, $this->password);
        if ($this->isColumnModified(UserPeer::SUBSCRIBED)) $criteria->add(UserPeer::SUBSCRIBED, $this->subscribed);
        if ($this->isColumnModified(UserPeer::REGISTERED)) $criteria->add(UserPeer::REGISTERED, $this->registered);
        if ($this->isColumnModified(UserPeer::UNIQUEID)) $criteria->add(UserPeer::UNIQUEID, $this->uniqueid);
        if ($this->isColumnModified(UserPeer::DATE_ADDED)) $criteria->add(UserPeer::DATE_ADDED, $this->date_added);
        if ($this->isColumnModified(UserPeer::LAST_LOGIN)) $criteria->add(UserPeer::LAST_LOGIN, $this->last_login);

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
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::ID, $this->id);
        $criteria->add(UserPeer::EMAIL, $this->email);

        return $criteria;
    }

    /**
     * Returns the composite primary key for this object.
     * The array elements will be in same order as specified in XML.
     * @return array
     */
    public function getPrimaryKey()
    {
        $pks = array();
        $pks[0] = $this->getId();
        $pks[1] = $this->getEmail();

        return $pks;
    }

    /**
     * Set the [composite] primary key.
     *
     * @param array $keys The elements of the composite key (order must match the order in XML file).
     * @return void
     */
    public function setPrimaryKey($keys)
    {
        $this->setId($keys[0]);
        $this->setEmail($keys[1]);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return (null === $this->getId()) && (null === $this->getEmail());
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of User (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setEmail($this->getEmail());
        $copyObj->setName($this->getName());
        $copyObj->setPassword($this->getPassword());
        $copyObj->setSubscribed($this->getSubscribed());
        $copyObj->setRegistered($this->getRegistered());
        $copyObj->setUniqueid($this->getUniqueid());
        $copyObj->setDateAdded($this->getDateAdded());
        $copyObj->setLastLogin($this->getLastLogin());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getTracks() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTrack($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getPlaylists() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPlaylist($relObj->copy($deepCopy));
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
     * @return User Clone of current object.
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
     * @return UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
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
        if ('Track' == $relationName) {
            $this->initTracks();
        }
        if ('Playlist' == $relationName) {
            $this->initPlaylists();
        }
    }

    /**
     * Clears out the collTracks collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addTracks()
     */
    public function clearTracks()
    {
        $this->collTracks = null; // important to set this to null since that means it is uninitialized
        $this->collTracksPartial = null;

        return $this;
    }

    /**
     * reset is the collTracks collection loaded partially
     *
     * @return void
     */
    public function resetPartialTracks($v = true)
    {
        $this->collTracksPartial = $v;
    }

    /**
     * Initializes the collTracks collection.
     *
     * By default this just sets the collTracks collection to an empty array (like clearcollTracks());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTracks($overrideExisting = true)
    {
        if (null !== $this->collTracks && !$overrideExisting) {
            return;
        }
        $this->collTracks = new PropelObjectCollection();
        $this->collTracks->setModel('Track');
    }

    /**
     * Gets an array of Track objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Track[] List of Track objects
     * @throws PropelException
     */
    public function getTracks($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTracksPartial && !$this->isNew();
        if (null === $this->collTracks || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTracks) {
                // return empty collection
                $this->initTracks();
            } else {
                $collTracks = TrackQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTracksPartial && count($collTracks)) {
                      $this->initTracks(false);

                      foreach ($collTracks as $obj) {
                        if (false == $this->collTracks->contains($obj)) {
                          $this->collTracks->append($obj);
                        }
                      }

                      $this->collTracksPartial = true;
                    }

                    $collTracks->getInternalIterator()->rewind();

                    return $collTracks;
                }

                if ($partial && $this->collTracks) {
                    foreach ($this->collTracks as $obj) {
                        if ($obj->isNew()) {
                            $collTracks[] = $obj;
                        }
                    }
                }

                $this->collTracks = $collTracks;
                $this->collTracksPartial = false;
            }
        }

        return $this->collTracks;
    }

    /**
     * Sets a collection of Track objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tracks A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setTracks(PropelCollection $tracks, PropelPDO $con = null)
    {
        $tracksToDelete = $this->getTracks(new Criteria(), $con)->diff($tracks);


        $this->tracksScheduledForDeletion = $tracksToDelete;

        foreach ($tracksToDelete as $trackRemoved) {
            $trackRemoved->setUser(null);
        }

        $this->collTracks = null;
        foreach ($tracks as $track) {
            $this->addTrack($track);
        }

        $this->collTracks = $tracks;
        $this->collTracksPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Track objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Track objects.
     * @throws PropelException
     */
    public function countTracks(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTracksPartial && !$this->isNew();
        if (null === $this->collTracks || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTracks) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTracks());
            }
            $query = TrackQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collTracks);
    }

    /**
     * Method called to associate a Track object to this object
     * through the Track foreign key attribute.
     *
     * @param   Track $l Track
     * @return User The current object (for fluent API support)
     */
    public function addTrack(Track $l)
    {
        if ($this->collTracks === null) {
            $this->initTracks();
            $this->collTracksPartial = true;
        }
        if (!in_array($l, $this->collTracks->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTrack($l);
        }

        return $this;
    }

    /**
     * @param	Track $track The track object to add.
     */
    protected function doAddTrack($track)
    {
        $this->collTracks[]= $track;
        $track->setUser($this);
    }

    /**
     * @param	Track $track The track object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeTrack($track)
    {
        if ($this->getTracks()->contains($track)) {
            $this->collTracks->remove($this->collTracks->search($track));
            if (null === $this->tracksScheduledForDeletion) {
                $this->tracksScheduledForDeletion = clone $this->collTracks;
                $this->tracksScheduledForDeletion->clear();
            }
            $this->tracksScheduledForDeletion[]= clone $track;
            $track->setUser(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Tracks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Track[] List of Track objects
     */
    public function getTracksJoinArtist($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TrackQuery::create(null, $criteria);
        $query->joinWith('Artist', $join_behavior);

        return $this->getTracks($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related Tracks from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Track[] List of Track objects
     */
    public function getTracksJoinAlbum($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = TrackQuery::create(null, $criteria);
        $query->joinWith('Album', $join_behavior);

        return $this->getTracks($query, $con);
    }

    /**
     * Clears out the collPlaylists collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addPlaylists()
     */
    public function clearPlaylists()
    {
        $this->collPlaylists = null; // important to set this to null since that means it is uninitialized
        $this->collPlaylistsPartial = null;

        return $this;
    }

    /**
     * reset is the collPlaylists collection loaded partially
     *
     * @return void
     */
    public function resetPartialPlaylists($v = true)
    {
        $this->collPlaylistsPartial = $v;
    }

    /**
     * Initializes the collPlaylists collection.
     *
     * By default this just sets the collPlaylists collection to an empty array (like clearcollPlaylists());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPlaylists($overrideExisting = true)
    {
        if (null !== $this->collPlaylists && !$overrideExisting) {
            return;
        }
        $this->collPlaylists = new PropelObjectCollection();
        $this->collPlaylists->setModel('PlayList');
    }

    /**
     * Gets an array of PlayList objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PlayList[] List of PlayList objects
     * @throws PropelException
     */
    public function getPlaylists($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPlaylistsPartial && !$this->isNew();
        if (null === $this->collPlaylists || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPlaylists) {
                // return empty collection
                $this->initPlaylists();
            } else {
                $collPlaylists = PlayListQuery::create(null, $criteria)
                    ->filterByUser($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPlaylistsPartial && count($collPlaylists)) {
                      $this->initPlaylists(false);

                      foreach ($collPlaylists as $obj) {
                        if (false == $this->collPlaylists->contains($obj)) {
                          $this->collPlaylists->append($obj);
                        }
                      }

                      $this->collPlaylistsPartial = true;
                    }

                    $collPlaylists->getInternalIterator()->rewind();

                    return $collPlaylists;
                }

                if ($partial && $this->collPlaylists) {
                    foreach ($this->collPlaylists as $obj) {
                        if ($obj->isNew()) {
                            $collPlaylists[] = $obj;
                        }
                    }
                }

                $this->collPlaylists = $collPlaylists;
                $this->collPlaylistsPartial = false;
            }
        }

        return $this->collPlaylists;
    }

    /**
     * Sets a collection of Playlist objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $playlists A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setPlaylists(PropelCollection $playlists, PropelPDO $con = null)
    {
        $playlistsToDelete = $this->getPlaylists(new Criteria(), $con)->diff($playlists);


        $this->playlistsScheduledForDeletion = $playlistsToDelete;

        foreach ($playlistsToDelete as $playlistRemoved) {
            $playlistRemoved->setUser(null);
        }

        $this->collPlaylists = null;
        foreach ($playlists as $playlist) {
            $this->addPlaylist($playlist);
        }

        $this->collPlaylists = $playlists;
        $this->collPlaylistsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PlayList objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PlayList objects.
     * @throws PropelException
     */
    public function countPlaylists(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPlaylistsPartial && !$this->isNew();
        if (null === $this->collPlaylists || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPlaylists) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPlaylists());
            }
            $query = PlayListQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUser($this)
                ->count($con);
        }

        return count($this->collPlaylists);
    }

    /**
     * Method called to associate a PlayList object to this object
     * through the PlayList foreign key attribute.
     *
     * @param   PlayList $l PlayList
     * @return User The current object (for fluent API support)
     */
    public function addPlaylist(PlayList $l)
    {
        if ($this->collPlaylists === null) {
            $this->initPlaylists();
            $this->collPlaylistsPartial = true;
        }
        if (!in_array($l, $this->collPlaylists->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPlaylist($l);
        }

        return $this;
    }

    /**
     * @param	Playlist $playlist The playlist object to add.
     */
    protected function doAddPlaylist($playlist)
    {
        $this->collPlaylists[]= $playlist;
        $playlist->setUser($this);
    }

    /**
     * @param	Playlist $playlist The playlist object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removePlaylist($playlist)
    {
        if ($this->getPlaylists()->contains($playlist)) {
            $this->collPlaylists->remove($this->collPlaylists->search($playlist));
            if (null === $this->playlistsScheduledForDeletion) {
                $this->playlistsScheduledForDeletion = clone $this->collPlaylists;
                $this->playlistsScheduledForDeletion->clear();
            }
            $this->playlistsScheduledForDeletion[]= clone $playlist;
            $playlist->setUser(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->email = null;
        $this->name = null;
        $this->password = null;
        $this->subscribed = null;
        $this->registered = null;
        $this->uniqueid = null;
        $this->date_added = null;
        $this->last_login = null;
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
            if ($this->collTracks) {
                foreach ($this->collTracks as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collPlaylists) {
                foreach ($this->collPlaylists as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collTracks instanceof PropelCollection) {
            $this->collTracks->clearIterator();
        }
        $this->collTracks = null;
        if ($this->collPlaylists instanceof PropelCollection) {
            $this->collPlaylists->clearIterator();
        }
        $this->collPlaylists = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
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
