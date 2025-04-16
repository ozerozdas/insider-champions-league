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

export default function Welcome({ standings, fixture }: { standings: Array<any>, fixture: Array<any> }) {
    return (
        <Layout>
            <Head title="Dashboard" />

            <div className="container mx-auto max-w-7xl px-4 py-8 min-h-[calc(50vh)]">
                <Tabs defaultValue="standings">
                    <TabsList className="grid w-full grid-cols-2">
                        <TabsTrigger value="standings">Standings</TabsTrigger>
                        <TabsTrigger value="fixture">Fixture</TabsTrigger>
                    </TabsList>
                    <TabsContent value="standings">
                        <LeagueTable standings={standings} />
                    </TabsContent>
                    <TabsContent value="fixture">
                        <FixtureTable matches={fixture} />
                    </TabsContent>
                </Tabs>
            </div>
        </Layout>
    );
}
