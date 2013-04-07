<?php


/**
 * Base class that represents a query for the 'track' table.
 *
 *
 *
 * @method TrackQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TrackQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method TrackQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method TrackQuery orderByGenre($order = Criteria::ASC) Order by the genre column
 * @method TrackQuery orderByYear($order = Criteria::ASC) Order by the year column
 * @method TrackQuery orderByDateAdded($order = Criteria::ASC) Order by the date_added column
 * @method TrackQuery orderByArtistId($order = Criteria::ASC) Order by the artist_id column
 * @method TrackQuery orderByAlbumId($order = Criteria::ASC) Order by the album_id column
 * @method TrackQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 *
 * @method TrackQuery groupById() Group by the id column
 * @method TrackQuery groupByUrl() Group by the url column
 * @method TrackQuery groupByTitle() Group by the title column
 * @method TrackQuery groupByGenre() Group by the genre column
 * @method TrackQuery groupByYear() Group by the year column
 * @method TrackQuery groupByDateAdded() Group by the date_added column
 * @method TrackQuery groupByArtistId() Group by the artist_id column
 * @method TrackQuery groupByAlbumId() Group by the album_id column
 * @method TrackQuery groupByUserId() Group by the user_id column
 *
 * @method TrackQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TrackQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TrackQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TrackQuery leftJoinArtist($relationAlias = null) Adds a LEFT JOIN clause to the query using the Artist relation
 * @method TrackQuery rightJoinArtist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Artist relation
 * @method TrackQuery innerJoinArtist($relationAlias = null) Adds a INNER JOIN clause to the query using the Artist relation
 *
 * @method TrackQuery leftJoinAlbum($relationAlias = null) Adds a LEFT JOIN clause to the query using the Album relation
 * @method TrackQuery rightJoinAlbum($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Album relation
 * @method TrackQuery innerJoinAlbum($relationAlias = null) Adds a INNER JOIN clause to the query using the Album relation
 *
 * @method TrackQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method TrackQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method TrackQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method TrackQuery leftJoinPlayListTrack($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlayListTrack relation
 * @method TrackQuery rightJoinPlayListTrack($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlayListTrack relation
 * @method TrackQuery innerJoinPlayListTrack($relationAlias = null) Adds a INNER JOIN clause to the query using the PlayListTrack relation
 *
 * @method Track findOne(PropelPDO $con = null) Return the first Track matching the query
 * @method Track findOneOrCreate(PropelPDO $con = null) Return the first Track matching the query, or a new Track object populated from the query conditions when no match is found
 *
 * @method Track findOneByUrl(string $url) Return the first Track filtered by the url column
 * @method Track findOneByTitle(string $title) Return the first Track filtered by the title column
 * @method Track findOneByGenre(string $genre) Return the first Track filtered by the genre column
 * @method Track findOneByYear(int $year) Return the first Track filtered by the year column
 * @method Track findOneByDateAdded(string $date_added) Return the first Track filtered by the date_added column
 * @method Track findOneByArtistId(int $artist_id) Return the first Track filtered by the artist_id column
 * @method Track findOneByAlbumId(int $album_id) Return the first Track filtered by the album_id column
 * @method Track findOneByUserId(int $user_id) Return the first Track filtered by the user_id column
 *
 * @method array findById(int $id) Return Track objects filtered by the id column
 * @method array findByUrl(string $url) Return Track objects filtered by the url column
 * @method array findByTitle(string $title) Return Track objects filtered by the title column
 * @method array findByGenre(string $genre) Return Track objects filtered by the genre column
 * @method array findByYear(int $year) Return Track objects filtered by the year column
 * @method array findByDateAdded(string $date_added) Return Track objects filtered by the date_added column
 * @method array findByArtistId(int $artist_id) Return Track objects filtered by the artist_id column
 * @method array findByAlbumId(int $album_id) Return Track objects filtered by the album_id column
 * @method array findByUserId(int $user_id) Return Track objects filtered by the user_id column
 *
 * @package    propel.generator.rockalist.om
 */
abstract class BaseTrackQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTrackQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'rockalist', $modelName = 'Track', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TrackQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TrackQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TrackQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TrackQuery) {
            return $criteria;
        }
        $query = new TrackQuery();
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
     * @return   Track|Track[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TrackPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TrackPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Track A model object, or null if the key is not found
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
     * @return                 Track A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `url`, `title`, `genre`, `year`, `date_added`, `artist_id`, `album_id`, `user_id` FROM `track` WHERE `id` = :p0';
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
            $obj = new Track();
            $obj->hydrate($row);
            TrackPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Track|Track[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Track[]|mixed the list of results, formatted by the current formatter
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
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TrackPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TrackPeer::ID, $keys, Criteria::IN);
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
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TrackPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TrackPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrackPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TrackPeer::URL, $url, $comparison);
    }

    /**
     * Filter the query on the title column
     *
     * Example usage:
     * <code>
     * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
     * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $title The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByTitle($title = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($title)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $title)) {
                $title = str_replace('*', '%', $title);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TrackPeer::TITLE, $title, $comparison);
    }

    /**
     * Filter the query on the genre column
     *
     * Example usage:
     * <code>
     * $query->filterByGenre('fooValue');   // WHERE genre = 'fooValue'
     * $query->filterByGenre('%fooValue%'); // WHERE genre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $genre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByGenre($genre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($genre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $genre)) {
                $genre = str_replace('*', '%', $genre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TrackPeer::GENRE, $genre, $comparison);
    }

    /**
     * Filter the query on the year column
     *
     * Example usage:
     * <code>
     * $query->filterByYear(1234); // WHERE year = 1234
     * $query->filterByYear(array(12, 34)); // WHERE year IN (12, 34)
     * $query->filterByYear(array('min' => 12)); // WHERE year >= 12
     * $query->filterByYear(array('max' => 12)); // WHERE year <= 12
     * </code>
     *
     * @param     mixed $year The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByYear($year = null, $comparison = null)
    {
        if (is_array($year)) {
            $useMinMax = false;
            if (isset($year['min'])) {
                $this->addUsingAlias(TrackPeer::YEAR, $year['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($year['max'])) {
                $this->addUsingAlias(TrackPeer::YEAR, $year['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrackPeer::YEAR, $year, $comparison);
    }

    /**
     * Filter the query on the date_added column
     *
     * Example usage:
     * <code>
     * $query->filterByDateAdded('2011-03-14'); // WHERE date_added = '2011-03-14'
     * $query->filterByDateAdded('now'); // WHERE date_added = '2011-03-14'
     * $query->filterByDateAdded(array('max' => 'yesterday')); // WHERE date_added > '2011-03-13'
     * </code>
     *
     * @param     mixed $dateAdded The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByDateAdded($dateAdded = null, $comparison = null)
    {
        if (is_array($dateAdded)) {
            $useMinMax = false;
            if (isset($dateAdded['min'])) {
                $this->addUsingAlias(TrackPeer::DATE_ADDED, $dateAdded['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($dateAdded['max'])) {
                $this->addUsingAlias(TrackPeer::DATE_ADDED, $dateAdded['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrackPeer::DATE_ADDED, $dateAdded, $comparison);
    }

    /**
     * Filter the query on the artist_id column
     *
     * Example usage:
     * <code>
     * $query->filterByArtistId(1234); // WHERE artist_id = 1234
     * $query->filterByArtistId(array(12, 34)); // WHERE artist_id IN (12, 34)
     * $query->filterByArtistId(array('min' => 12)); // WHERE artist_id >= 12
     * $query->filterByArtistId(array('max' => 12)); // WHERE artist_id <= 12
     * </code>
     *
     * @see       filterByArtist()
     *
     * @param     mixed $artistId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByArtistId($artistId = null, $comparison = null)
    {
        if (is_array($artistId)) {
            $useMinMax = false;
            if (isset($artistId['min'])) {
                $this->addUsingAlias(TrackPeer::ARTIST_ID, $artistId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($artistId['max'])) {
                $this->addUsingAlias(TrackPeer::ARTIST_ID, $artistId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrackPeer::ARTIST_ID, $artistId, $comparison);
    }

    /**
     * Filter the query on the album_id column
     *
     * Example usage:
     * <code>
     * $query->filterByAlbumId(1234); // WHERE album_id = 1234
     * $query->filterByAlbumId(array(12, 34)); // WHERE album_id IN (12, 34)
     * $query->filterByAlbumId(array('min' => 12)); // WHERE album_id >= 12
     * $query->filterByAlbumId(array('max' => 12)); // WHERE album_id <= 12
     * </code>
     *
     * @see       filterByAlbum()
     *
     * @param     mixed $albumId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByAlbumId($albumId = null, $comparison = null)
    {
        if (is_array($albumId)) {
            $useMinMax = false;
            if (isset($albumId['min'])) {
                $this->addUsingAlias(TrackPeer::ALBUM_ID, $albumId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($albumId['max'])) {
                $this->addUsingAlias(TrackPeer::ALBUM_ID, $albumId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrackPeer::ALBUM_ID, $albumId, $comparison);
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id >= 12
     * $query->filterByUserId(array('max' => 12)); // WHERE user_id <= 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(TrackPeer::USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(TrackPeer::USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TrackPeer::USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query by a related Artist object
     *
     * @param   Artist|PropelObjectCollection $artist The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TrackQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByArtist($artist, $comparison = null)
    {
        if ($artist instanceof Artist) {
            return $this
                ->addUsingAlias(TrackPeer::ARTIST_ID, $artist->getId(), $comparison);
        } elseif ($artist instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TrackPeer::ARTIST_ID, $artist->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByArtist() only accepts arguments of type Artist or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Artist relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function joinArtist($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Artist');

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
            $this->addJoinObject($join, 'Artist');
        }

        return $this;
    }

    /**
     * Use the Artist relation Artist object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   ArtistQuery A secondary query class using the current class as primary query
     */
    public function useArtistQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinArtist($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Artist', 'ArtistQuery');
    }

    /**
     * Filter the query by a related Album object
     *
     * @param   Album|PropelObjectCollection $album The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TrackQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByAlbum($album, $comparison = null)
    {
        if ($album instanceof Album) {
            return $this
                ->addUsingAlias(TrackPeer::ALBUM_ID, $album->getId(), $comparison);
        } elseif ($album instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TrackPeer::ALBUM_ID, $album->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByAlbum() only accepts arguments of type Album or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Album relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function joinAlbum($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Album');

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
            $this->addJoinObject($join, 'Album');
        }

        return $this;
    }

    /**
     * Use the Album relation Album object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   AlbumQuery A secondary query class using the current class as primary query
     */
    public function useAlbumQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinAlbum($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Album', 'AlbumQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TrackQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(TrackPeer::USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TrackPeer::USER_ID, $user->toKeyValue('Id', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', 'UserQuery');
    }

    /**
     * Filter the query by a related PlayListTrack object
     *
     * @param   PlayListTrack|PropelObjectCollection $playListTrack  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TrackQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPlayListTrack($playListTrack, $comparison = null)
    {
        if ($playListTrack instanceof PlayListTrack) {
            return $this
                ->addUsingAlias(TrackPeer::ID, $playListTrack->getTrackId(), $comparison);
        } elseif ($playListTrack instanceof PropelObjectCollection) {
            return $this
                ->usePlayListTrackQuery()
                ->filterByPrimaryKeys($playListTrack->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlayListTrack() only accepts arguments of type PlayListTrack or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlayListTrack relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function joinPlayListTrack($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlayListTrack');

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
            $this->addJoinObject($join, 'PlayListTrack');
        }

        return $this;
    }

    /**
     * Use the PlayListTrack relation PlayListTrack object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   PlayListTrackQuery A secondary query class using the current class as primary query
     */
    public function usePlayListTrackQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlayListTrack($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlayListTrack', 'PlayListTrackQuery');
    }

    /**
     * Filter the query by a related PlayList object
     * using the playlisttrack table as cross reference
     *
     * @param   PlayList $playList the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   TrackQuery The current query, for fluid interface
     */
    public function filterByPlayList($playList, $comparison = Criteria::EQUAL)
    {
        return $this
            ->usePlayListTrackQuery()
            ->filterByPlayList($playList, $comparison)
            ->endUse();
    }

    /**
     * Exclude object from result
     *
     * @param   Track $track Object to remove from the list of results
     *
     * @return TrackQuery The current query, for fluid interface
     */
    public function prune($track = null)
    {
        if ($track) {
            $this->addUsingAlias(TrackPeer::ID, $track->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
