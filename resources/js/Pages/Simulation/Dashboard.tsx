import { Head } from '@inertiajs/react';
import Layout from '@/Layouts/Layout';
import LeagueTable from '@/Components/LeagueTable';
import FixtureTable from '@/Components/FixtureTable';
import {
    Tabs,
    TabsContent,
    TabsList,
    TabsTrigger,
} from "@/Components/ui/tabs"
import ChampionshipOddsTable from '@/Components/ChampionshipOddsTable';
import PlayMatch from '@/Components/PlayMatch';

export default function Welcome({ standings, fixture, predictions }: { standings: Array<any>, fixture: Array<any>, predictions: Array<any> }) {
    return (
        <Layout>
            <Head title="Dashboard" />

            <div className="container mx-auto max-w-7xl px-4 py-8 min-h-[calc(50vh)]">
                <Tabs defaultValue="standings">
                    <TabsList className="grid h-full w-full grid-cols-1 md:grid-cols-3">
                        <TabsTrigger value="standings">Standings</TabsTrigger>
                        <TabsTrigger value="fixture">Fixture</TabsTrigger>
                        <TabsTrigger value="predictions">Championship Predictions</TabsTrigger>
                    </TabsList>
                    <TabsContent value="standings">
                        <LeagueTable standings={standings} />
                    </TabsContent>
                    <TabsContent value="fixture">
                        <FixtureTable matches={fixture} />
                    </TabsContent>
                    <TabsContent value="predictions">
                        <ChampionshipOddsTable odds={predictions} />
                    </TabsContent>
                </Tabs>

                <PlayMatch />
            </div>
        </Layout>
    );
}
