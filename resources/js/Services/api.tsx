import axios from 'axios';

export const getStandings = () => axios.get('/api/standings');
export const getFixture = () => axios.get('/api/fixture');
export const getChampionshipPredictions = () => axios.get('/api/championship-predictions');

export const playAllWeeks = () => axios.post('/api/simulate-all');
export const playNextWeek = () => axios.post('/api/simulate-next');
export const resetLeague = () => axios.post('/api/reset');