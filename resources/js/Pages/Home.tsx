import { useState } from 'react';
import { Head, router } from '@inertiajs/react';
import { Loader2 } from 'lucide-react';
import { useToast } from "@/hooks/use-toast";
import Layout from '@/Layouts/Layout';
import { Button } from "@/Components/ui/button";
import { Progress } from '@/Components/ui/progress';

export default function Welcome({ teams }: { teams: any }) {
    const [loading, setLoading] = useState(false);
    const { toast } = useToast();

    const handleStartSimulation = () => {
        setLoading(true);
        router.post(route('simulation.start'), {}, {
            onSuccess: () => {
                router.get(route('simulation.dashboard'));
            },
            onError: (error) => {
                toast({
                    description: error[0],
                    duration: 3000
                });
            },
            onFinish: () => {
                setLoading(false);
            }
        });
    };

    return (
        <Layout>
            <Head title="Homepage" />

            <div className="bg-white p-10 rounded-xl shadow-xl text-center space-y-6 w-full max-w-xl mx-auto">

                <h1 className="text-3xl font-bold">
                    Tournament Teams
                </h1>
                <div className="grid grid-cols-2 gap-4">
                    {
                        teams.map((team: any) => (
                            <div key={team.id} className="grid place-items-center bg-gray-100 p-4 rounded-lg shadow">
                                <span className="text-lg font-semibold">{team.name}</span>
                                <Progress value={team.strength} className="w-full mt-2" />
                            </div>
                        ))
                    }
                </div>

                <Button className="w-full" onClick={handleStartSimulation} disabled={loading}>
                    {
                        loading ? (
                            <>
                                <Loader2 className="animate-spin mr-2" />
                                <span>Simulation Starting</span>
                            </>
                        ) : (
                            <>
                                Start Simulation
                            </>
                        )
                    }
                </Button>
            </div>

        </ Layout>
    );
}
