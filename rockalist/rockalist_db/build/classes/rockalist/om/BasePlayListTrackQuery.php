<?php


/**
 * Base class that represents a query for the 'playlisttrack' table.
 *
 *
 *
 * @method PlayListTrackQuery orderById($order = Criteria::ASC) Order by the id column
 * @method PlayListTrackQuery orderBySynced($order = Criteria::ASC) Order by the synced column
 * @method PlayListTrackQuery orderByPlaylistId($order = Criteria::ASC) Order by the playlist_id column
 * @method PlayListTrackQuery orderByTrackId($order = Criteria::ASC) Order by the track_id column
 *
 * @method PlayListTrackQuery groupById() Group by the id column
 * @method PlayListTrackQuery groupBySynced() Group by the synced column
 * @method PlayListTrackQuery groupByPlaylistId() Group by the playlist_id column
 * @method PlayListTrackQuery groupByTrackId() Group by the track_id column
 *
 * @method PlayListTrackQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PlayListTrackQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PlayListTrackQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PlayListTrackQuery leftJoinPlayList($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlayList relation
 * @method PlayListTrackQuery rightJoinPlayList($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlayList relation
 * @method PlayListTrackQuery innerJoinPlayList($relationAlias = null) Adds a INNER JOIN clause to the query using the PlayList relation
 *
 * @method PlayListTrackQuery leftJoinTrack($relationAlias = null) Adds a LEFT JOIN clause to the query using the Track relation
 * @method PlayListTrackQuery rightJoinTrack($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Track relation
 * @method PlayListTrackQuery innerJoinTrack($relationAlias = null) Adds a INNER JOIN clause to the query using the Track relation
 *
 * @method PlayListTrack findOne(PropelPDO $con = null) Return the first PlayListTrack matching the query
 * @method PlayListTrack findOneOrCreate(PropelPDO $con = null) Return the first PlayListTrack matching the query, or a new PlayListTrack object populated from the query conditions when no match is found
 *
 * @method PlayListTrack findOneBySynced(boolean $synced) Return the first PlayListTrack filtered by the synced column
 * @method PlayListTrack findOneByPlaylistId(int $playlist_id) Return the first PlayListTrack filtered by the playlist_id column
 * @method PlayListTrack findOneByTrackId(int $track_id) Return the first PlayListTrack filtered by the track_id column
 *
 * @method array findById(int $id) Return PlayListTrack objects filtered by the id column
 * @method array findBySynced(boolean $synced) Return PlayListTrack objects filtered by the synced column
 * @method array findByPlaylistId(int $playlist_id) Return PlayListTrack objects filtered by the playlist_id column
 * @method array findByTrackId(int $track_id) Return PlayListTrack objects filtered by the track_id column
 *
 * @package    propel.generator.rockalist.om
 */
abstract class BasePlayListTrackQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePlayListTrackQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'rockalist', $modelName = 'PlayListTrack', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PlayListTrackQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PlayListTrackQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PlayListTrackQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PlayListTrackQuery) {
            return $criteria;
        }
        $query = new PlayListTrackQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   PlayListTrack|PlayListTrack[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PlayListTrackPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PlayListTrackPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 PlayListTrack A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 PlayListTrack A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `synced`, `playlist_id`, `track_id` FROM `playlisttrack` WHERE `id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new PlayListTrack();
            $obj->hydrate($row);
            PlayListTrackPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return PlayListTrack|PlayListTrack[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|PlayListTrack[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlayListTrackPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlayListTrackPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(PlayListTrackPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(PlayListTrackPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayListTrackPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the synced column
     *
     * Example usage:
     * <code>
     * $query->filterBySynced(true); // WHERE synced = true
     * $query->filterBySynced('yes'); // WHERE synced = true
     * </code>
     *
     * @param     boolean|string $synced The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function filterBySynced($synced = null, $comparison = null)
    {
        if (is_string($synced)) {
            $synced = in_array(strtolower($synced), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PlayListTrackPeer::SYNCED, $synced, $comparison);
    }

    /**
     * Filter the query on the playlist_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaylistId(1234); // WHERE playlist_id = 1234
     * $query->filterByPlaylistId(array(12, 34)); // WHERE playlist_id IN (12, 34)
     * $query->filterByPlaylistId(array('min' => 12)); // WHERE playlist_id >= 12
     * $query->filterByPlaylistId(array('max' => 12)); // WHERE playlist_id <= 12
     * </code>
     *
     * @see       filterByPlayList()
     *
     * @param     mixed $playlistId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function filterByPlaylistId($playlistId = null, $comparison = null)
    {
        if (is_array($playlistId)) {
            $useMinMax = false;
            if (isset($playlistId['min'])) {
                $this->addUsingAlias(PlayListTrackPeer::PLAYLIST_ID, $playlistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($playlistId['max'])) {
                $this->addUsingAlias(PlayListTrackPeer::PLAYLIST_ID, $playlistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayListTrackPeer::PLAYLIST_ID, $playlistId, $comparison);
    }

    /**
     * Filter the query on the track_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTrackId(1234); // WHERE track_id = 1234
     * $query->filterByTrackId(array(12, 34)); // WHERE track_id IN (12, 34)
     * $query->filterByTrackId(array('min' => 12)); // WHERE track_id >= 12
     * $query->filterByTrackId(array('max' => 12)); // WHERE track_id <= 12
     * </code>
     *
     * @see       filterByTrack()
     *
     * @param     mixed $trackId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function filterByTrackId($trackId = null, $comparison = null)
    {
        if (is_array($trackId)) {
            $useMinMax = false;
            if (isset($trackId['min'])) {
                $this->addUsingAlias(PlayListTrackPeer::TRACK_ID, $trackId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($trackId['max'])) {
                $this->addUsingAlias(PlayListTrackPeer::TRACK_ID, $trackId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlayListTrackPeer::TRACK_ID, $trackId, $comparison);
    }

    /**
     * Filter the query by a related PlayList object
     *
     * @param   PlayList|PropelObjectCollection $playList The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayListTrackQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPlayList($playList, $comparison = null)
    {
        if ($playList instanceof PlayList) {
            return $this
                ->addUsingAlias(PlayListTrackPeer::PLAYLIST_ID, $playList->getId(), $comparison);
        } elseif ($playList instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlayListTrackPeer::PLAYLIST_ID, $playList->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByPlayList() only accepts arguments of type PlayList or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlayList relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function joinPlayList($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlayList');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'PlayList');
        }

        return $this;
    }

    /**
     * Use the PlayList relation PlayList object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   PlayListQuery A secondary query class using the current class as primary query
     */
    public function usePlayListQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlayList($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlayList', 'PlayListQuery');
    }

    /**
     * Filter the query by a related Track object
     *
     * @param   Track|PropelObjectCollection $track The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlayListTrackQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTrack($track, $comparison = null)
    {
        if ($track instanceof Track) {
            return $this
                ->addUsingAlias(PlayListTrackPeer::TRACK_ID, $track->getId(), $comparison);
        } elseif ($track instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PlayListTrackPeer::TRACK_ID, $track->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTrack() only accepts arguments of type Track or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Track relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function joinTrack($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Track');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Track');
        }

        return $this;
    }

    /**
     * Use the Track relation Track object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   TrackQuery A secondary query class using the current class as primary query
     */
    public function useTrackQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTrack($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Track', 'TrackQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   PlayListTrack $playListTrack Object to remove from the list of results
     *
     * @return PlayListTrackQuery The current query, for fluid interface
     */
    public function prune($playListTrack = null)
    {
        if ($playListTrack) {
            $this->addUsingAlias(PlayListTrackPeer::ID, $playListTrack->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
